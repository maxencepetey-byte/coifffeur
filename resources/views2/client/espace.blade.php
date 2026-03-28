@extends('layout')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
    <h1 class="text-3xl font-bold text-white uppercase tracking-wide">Mon Espace Client</h1>
    <a href="{{ route('client.profile.edit') }}"
       class="px-5 py-2.5 bg-zinc-900 border border-zinc-700 text-white rounded-md hover:border-yellow-500 hover:text-yellow-500 transition shadow-sm font-medium text-sm uppercase tracking-wide">
      Modifier mon profil
    </a>
</div>

@if(session('success'))
  <div class="bg-green-500/10 border border-green-500 text-green-400 p-4 rounded-md mb-8 text-sm font-medium">
      {{ session('success') }}
  </div>
@endif

{{-- ==== Prendre rendez-vous ==== --}}
<div class="bg-zinc-900 rounded-xl shadow-2xl border border-zinc-800 overflow-hidden mb-16">
  <div class="p-6 border-b border-zinc-800 bg-zinc-950/50">
      <h2 class="text-xl font-bold text-white flex items-center uppercase tracking-wide">
          <span class="w-2 h-6 bg-yellow-500 mr-3 rounded-sm"></span>Prendre rendez-vous
      </h2>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm text-gray-300 whitespace-nowrap">
      <thead class="bg-zinc-950 text-zinc-400 uppercase text-xs tracking-wider border-b border-zinc-800">
        <tr>
          <th class="px-6 py-4 font-medium">Nom</th>
          <th class="px-6 py-4 font-medium">Prénom</th>
          <th class="px-6 py-4 font-medium">Email</th>
          <th class="px-6 py-4 font-medium">Disponibilité</th>
          <th class="px-6 py-4 font-medium">Type de coupe</th>
          <th class="px-6 py-4 font-medium">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-zinc-800/50">
        @forelse($coiffeurs as $coiffeur)
          @php
            $dispos = $coiffeur->disponibilites->sortBy('debut');
            $rowspan = $dispos->count() ?: 1;
          @endphp

          @if($dispos->isNotEmpty())
            @foreach($dispos as $i => $dispo)
              <tr class="hover:bg-zinc-800/30 transition">
                @if($i === 0)
                  <td rowspan="{{ $rowspan }}" class="px-6 py-4 align-top border-r border-zinc-800/50 font-medium text-white">{{ $coiffeur->utilisateur->nom ?? '—' }}</td>
                  <td rowspan="{{ $rowspan }}" class="px-6 py-4 align-top border-r border-zinc-800/50">{{ $coiffeur->utilisateur->prenom ?? '—' }}</td>
                  <td rowspan="{{ $rowspan }}" class="px-6 py-4 align-top border-r border-zinc-800/50 text-zinc-500">{{ $coiffeur->utilisateur->email ?? '—' }}</td>
                @endif
                
                <td class="px-6 py-4 text-yellow-500 font-medium">
                  {{ \Carbon\Carbon::parse($dispo->debut)->format('d/m H:i') }}
                  <span class="text-zinc-500 mx-1">&rarr;</span>
                  {{ \Carbon\Carbon::parse($dispo->fin)->format('H:i') }}
                </td>

                <td class="px-6 py-3">
                  <form method="POST" action="{{ route('client.reserver') }}" class="flex items-center gap-3">
                    @csrf
                    <input type="hidden" name="disponibilite_id" value="{{ $dispo->id }}">
                    <input type="hidden" name="coiffeur_id" value="{{ $coiffeur->id }}">
                    <select name="type_de_coupe_id" required class="bg-zinc-950 border border-zinc-700 text-white rounded-md px-3 py-2 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 cursor-pointer">
                      <option value="">Type de coupe…</option>
                      @foreach($coiffeur->typesDeCoupes as $coupe)
                        <option value="{{ $coupe->id }}">{{ $coupe->nom }}</option>
                      @endforeach
                    </select>
                </td>
                <td class="px-6 py-3">
                    <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded-md text-xs font-bold hover:bg-yellow-600 transition uppercase tracking-wide">
                        Réserver
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr class="bg-zinc-900/50">
              <td class="px-6 py-4 font-medium text-white">{{ $coiffeur->utilisateur->nom ?? '—' }}</td>
              <td class="px-6 py-4">{{ $coiffeur->utilisateur->prenom ?? '—' }}</td>
              <td class="px-6 py-4 text-zinc-500">{{ $coiffeur->utilisateur->email ?? '—' }}</td>
              <td colspan="3" class="px-6 py-4 text-center text-zinc-500 italic">Aucune disponibilité pour le moment</td>
            </tr>
          @endif
        @empty
          <tr>
            <td colspan="6" class="px-6 py-10 text-center text-zinc-500">Aucun coiffeur disponible dans le système.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- ==== Mes réservations ==== --}}
<div class="bg-zinc-900 rounded-xl shadow-2xl border border-zinc-800 overflow-hidden mb-10">
  <div class="p-6 border-b border-zinc-800 bg-zinc-950/50">
      <h3 class="text-xl font-bold text-white flex items-center uppercase tracking-wide">
          <span class="w-2 h-6 bg-zinc-500 mr-3 rounded-sm"></span>Historique de mes réservations
      </h3>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm text-gray-300 whitespace-nowrap">
      <thead class="bg-zinc-950 text-zinc-400 uppercase text-xs tracking-wider border-b border-zinc-800">
        <tr>
          <th class="px-6 py-4 font-medium">Date & Heure</th>
          <th class="px-6 py-4 font-medium">Coiffeur</th>
          <th class="px-6 py-4 font-medium">Type de coupe</th>
          <th class="px-6 py-4 font-medium">Statut</th>
          <th class="px-6 py-4 font-medium">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-zinc-800/50">
        @forelse($reservations as $res)
          @php
            $nomStatut  = optional($res->statut)->nom;
            $isCanceled = mb_strtolower($nomStatut) === 'annulée';
          @endphp
          <tr class="hover:bg-zinc-800/30 transition {{ $isCanceled ? 'opacity-50' : '' }}">
            <td class="px-6 py-4 font-medium text-white">{{ \Carbon\Carbon::parse($res->date_heure)->format('d/m H:i') }}</td>
            <td class="px-6 py-4">{{ $res->coiffeur->utilisateur->nom }}</td>
            <td class="px-6 py-4">{{ $res->typeDeCoupe->nom }}</td>
            <td class="px-6 py-4">
              <span class="px-3 py-1 text-xs font-bold rounded-full uppercase tracking-wide {{ $isCanceled ? 'bg-red-500/10 text-red-500 border border-red-500/20' : 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/20' }}">
                {{ $nomStatut ? ucfirst($nomStatut) : 'En attente' }}
              </span>
            </td>
            <td class="px-6 py-4">
              @unless($isCanceled)
                <form method="POST" action="{{ route('client.reservations.annuler', $res->id) }}" onsubmit="return confirm('Confirmer l\'annulation ?');">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="text-red-500 hover:text-red-400 border border-red-500/50 hover:bg-red-500/10 px-3 py-1.5 rounded text-xs font-bold transition uppercase">Annuler</button>
                </form>
              @else
                <span class="text-zinc-600 text-xs uppercase">—</span>
              @endunless
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-6 py-10 text-center text-zinc-500">Aucune réservation trouvée.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection