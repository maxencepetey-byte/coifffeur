@extends('layout')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
    <h1 class="text-3xl font-bold text-white uppercase tracking-wide" style="font-family:'Cinzel',serif;">Mon Espace Client</h1>
    <a href="{{ route('client.profile.edit') }}"
       class="px-5 py-2.5 border text-white rounded-md transition shadow-sm font-medium text-xs uppercase tracking-widest hover:text-amber-400"
       style="background:#1C1106; border-color:rgba(212,168,67,.25); font-family:'Cinzel',serif;">
      Modifier mon profil
    </a>
</div>

@if(session('success'))
  <div class="bg-emerald-900/20 border border-emerald-600 text-emerald-400 p-4 rounded-md mb-8 text-sm font-medium">
      {{ session('success') }}
  </div>
@endif

{{-- ==== Prendre rendez-vous ==== --}}
<div class="rounded-xl shadow-2xl overflow-hidden mb-16 card-african">
  <div class="p-6 border-b flex items-center" style="background:rgba(212,168,67,.04); border-color:rgba(212,168,67,.12);">
      <h2 class="text-xl font-bold text-white flex items-center uppercase tracking-wide" style="font-family:'Cinzel',serif;">
          <span class="gold-line h-6"></span>Prendre rendez-vous
      </h2>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm text-stone-300 whitespace-nowrap">
      <thead class="text-stone-400 uppercase text-xs tracking-wider border-b" style="background:#0F0A04; border-color:rgba(212,168,67,.1);">
        <tr>
          <th class="px-6 py-4 font-medium">Nom</th>
          <th class="px-6 py-4 font-medium">Prénom</th>
          <th class="px-6 py-4 font-medium">Email</th>
          <th class="px-6 py-4 font-medium">Disponibilité</th>
          <th class="px-6 py-4 font-medium">Type de coupe</th>
          <th class="px-6 py-4 font-medium">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-stone-800/30">
        @forelse($coiffeurs as $coiffeur)
          @php
            $dispos = $coiffeur->disponibilites->sortBy('debut');
            $rowspan = $dispos->count() ?: 1;
          @endphp

          @if($dispos->isNotEmpty())
            @foreach($dispos as $i => $dispo)
              <tr class="transition">
                @if($i === 0)
                  <td rowspan="{{ $rowspan }}" class="px-6 py-4 align-top border-r font-medium text-white" style="border-color:rgba(212,168,67,.08);">{{ $coiffeur->utilisateur->nom ?? '—' }}</td>
                  <td rowspan="{{ $rowspan }}" class="px-6 py-4 align-top border-r" style="border-color:rgba(212,168,67,.08);">{{ $coiffeur->utilisateur->prenom ?? '—' }}</td>
                  <td rowspan="{{ $rowspan }}" class="px-6 py-4 align-top border-r text-stone-500" style="border-color:rgba(212,168,67,.08);">{{ $coiffeur->utilisateur->email ?? '—' }}</td>
                @endif
                
                <td class="px-6 py-4 text-amber-400 font-medium">
                  {{ \Carbon\Carbon::parse($dispo->debut)->format('d/m H:i') }}
                  <span class="text-stone-500 mx-1">&rarr;</span>
                  {{ \Carbon\Carbon::parse($dispo->fin)->format('H:i') }}
                </td>

                <td class="px-6 py-3">
                  <form method="POST" action="{{ route('client.reserver') }}" class="flex items-center gap-3">
                    @csrf
                    <input type="hidden" name="disponibilite_id" value="{{ $dispo->id }}">
                    <input type="hidden" name="coiffeur_id" value="{{ $coiffeur->id }}">
                    <select name="type_de_coupe_id" required class="border text-white rounded-md px-3 py-2 text-sm cursor-pointer" style="background:#0F0A04; border-color:#2D1F0A;">
                      <option value="">Type de coupe…</option>
                      @foreach($coiffeur->typesDeCoupes as $coupe)
                        <option value="{{ $coupe->id }}">{{ $coupe->nom }}</option>
                      @endforeach
                    </select>
                </td>
                <td class="px-6 py-3">
                    <button type="submit" class="btn-gold px-4 py-2 rounded-md text-xs font-bold uppercase tracking-wide">
                        Réserver
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td class="px-6 py-4 font-medium text-white">{{ $coiffeur->utilisateur->nom ?? '—' }}</td>
              <td class="px-6 py-4">{{ $coiffeur->utilisateur->prenom ?? '—' }}</td>
              <td class="px-6 py-4 text-stone-500">{{ $coiffeur->utilisateur->email ?? '—' }}</td>
              <td colspan="3" class="px-6 py-4 text-center text-stone-500 italic">Aucune disponibilité pour le moment</td>
            </tr>
          @endif
        @empty
          <tr>
            <td colspan="6" class="px-6 py-10 text-center text-stone-500">Aucun coiffeur disponible dans le système.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- ==== Mes réservations ==== --}}
<div class="rounded-xl shadow-2xl overflow-hidden mb-10 card-african">
  <div class="p-6 border-b flex items-center" style="background:rgba(212,168,67,.02); border-color:rgba(212,168,67,.08);">
      <h3 class="text-xl font-bold text-white flex items-center uppercase tracking-wide" style="font-family:'Cinzel',serif;">
          <span class="gold-line h-6" style="background:linear-gradient(180deg,#6b7280,#4b5563);"></span>Historique de mes réservations
      </h3>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm text-stone-300 whitespace-nowrap">
      <thead class="text-stone-400 uppercase text-xs tracking-wider border-b" style="background:#0F0A04; border-color:rgba(212,168,67,.08);">
        <tr>
          <th class="px-6 py-4 font-medium">Date & Heure</th>
          <th class="px-6 py-4 font-medium">Coiffeur</th>
          <th class="px-6 py-4 font-medium">Type de coupe</th>
          <th class="px-6 py-4 font-medium">Statut</th>
          <th class="px-6 py-4 font-medium">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-stone-800/30">
        @forelse($reservations as $res)
          @php
            $nomStatut  = optional($res->statut)->nom;
            $isCanceled = mb_strtolower($nomStatut) === 'annulée';
          @endphp
          <tr class="transition {{ $isCanceled ? 'opacity-50' : '' }}">
            <td class="px-6 py-4 font-medium text-white">{{ \Carbon\Carbon::parse($res->date_heure)->format('d/m H:i') }}</td>
            <td class="px-6 py-4">{{ $res->coiffeur->utilisateur->nom }}</td>
            <td class="px-6 py-4">{{ $res->typeDeCoupe->nom }}</td>
            <td class="px-6 py-4">
              <span class="px-3 py-1 text-xs font-bold rounded-full uppercase tracking-wide {{ $isCanceled ? 'badge-red' : 'badge-gold' }}">
                {{ $nomStatut ? ucfirst($nomStatut) : 'En attente' }}
              </span>
            </td>
            <td class="px-6 py-4">
              @unless($isCanceled)
                <form method="POST" action="{{ route('client.reservations.annuler', $res->id) }}" onsubmit="return confirm('Confirmer l\'annulation ?');">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="text-red-400 hover:text-red-300 border border-red-700/40 hover:bg-red-900/20 px-3 py-1.5 rounded text-xs font-bold transition uppercase">Annuler</button>
                </form>
              @else
                <span class="text-stone-600 text-xs uppercase">—</span>
              @endunless
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-6 py-10 text-center text-stone-500">Aucune réservation trouvée.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
