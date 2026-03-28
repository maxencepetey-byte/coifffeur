@extends('layout')

@section('content')

<div class="mb-10">
    <h1 class="text-3xl font-bold text-white uppercase tracking-wide mb-2" style="font-family:'Cinzel',serif;">Espace Professionnel</h1>
    <p class="text-stone-400 text-sm">Gérez votre planning et vos rendez-vous.</p>
</div>

@if(session('success'))
    <div class="bg-emerald-900/20 border border-emerald-600 text-emerald-400 p-4 rounded-md mb-8 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-12">
    
    {{-- Colonne de gauche : Formulaire + Dispos --}}
    <div class="xl:col-span-1 space-y-8">
        
        <div class="rounded-xl shadow-xl p-6 card-african">
            <h2 class="text-lg font-bold text-white uppercase tracking-wide mb-6 pb-3 flex items-center" style="font-family:'Cinzel',serif; border-bottom:1px solid rgba(212,168,67,.12);">
                <span class="gold-line h-5"></span>Ajouter une disponibilité
            </h2>
            <form method="POST" action="{{ route('coiffeur.disponibilites.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="date" class="block text-xs font-medium text-stone-400 mb-1 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Date :</label>
                    <input type="date" id="date" name="date" required class="w-full border text-white rounded px-3 py-2 text-sm transition [&::-webkit-calendar-picker-indicator]:filter [&::-webkit-calendar-picker-indicator]:invert" style="background:#0F0A04; border-color:#2D1F0A;">
                    @error('date') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="periode" class="block text-xs font-medium text-stone-400 mb-1 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Période :</label>
                    <select id="periode" name="periode" required class="w-full border text-white rounded px-3 py-2 text-sm transition cursor-pointer" style="background:#0F0A04; border-color:#2D1F0A;">
                        <option value="">-- Choisir --</option>
                        <option value="morning">Matinée (08:00–12:00)</option>
                        <option value="afternoon">Après-midi (13:00–17:00)</option>
                        <option value="full">Journée (08:00–17:00)</option>
                    </select>
                    @error('periode') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-gold w-full font-bold py-2.5 rounded uppercase tracking-widest text-sm mt-2" style="font-family:'Cinzel',serif;">
                    Ajouter
                </button>
            </form>
        </div>

        <div class="rounded-xl shadow-xl overflow-hidden card-african">
            <h2 class="text-lg font-bold text-white uppercase tracking-wide p-6 border-b flex items-center" style="font-family:'Cinzel',serif; background:rgba(212,168,67,.03); border-color:rgba(212,168,67,.1);">
                <span class="gold-line h-5"></span>Mes disponibilités
            </h2>
            <div class="overflow-x-auto max-h-[400px]">
                <table class="w-full text-left text-sm text-stone-300 whitespace-nowrap">
                    <thead class="text-stone-400 uppercase text-xs sticky top-0" style="background:#0F0A04;">
                        <tr>
                            <th class="px-5 py-3 font-medium border-b" style="border-color:rgba(212,168,67,.08);">Début</th>
                            <th class="px-5 py-3 font-medium border-b" style="border-color:rgba(212,168,67,.08);">Fin</th>
                            <th class="px-5 py-3 font-medium border-b" style="border-color:rgba(212,168,67,.08);">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-800/30">
                    @forelse($disponibilites as $dispo)
                        <tr class="transition">
                            <td class="px-5 py-3 text-amber-400">{{ \Carbon\Carbon::parse($dispo->debut)->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3 text-amber-400">{{ \Carbon\Carbon::parse($dispo->fin  )->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('coiffeur.disponibilites.destroy', $dispo) }}" onsubmit="return confirm('Supprimer cette disponibilité ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 hover:text-red-300 text-xs uppercase font-bold tracking-wide transition">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-8 text-center text-stone-500 italic">Aucune disponibilité définie</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Colonne de droite --}}
    <div class="xl:col-span-2 space-y-8">
        <div class="rounded-xl shadow-xl overflow-hidden card-african">
            <div class="p-6 border-b flex flex-col sm:flex-row justify-between items-center gap-4" style="background:rgba(212,168,67,.03); border-color:rgba(212,168,67,.1);">
                <h2 class="text-lg font-bold text-white uppercase tracking-wide flex items-center" style="font-family:'Cinzel',serif;">
                    <span class="gold-line h-5"></span>Planning des réservations
                </h2>
                
                <form method="GET" action="{{ route('coiffeur.espace') }}" class="flex items-center gap-2">
                    <input type="date" name="date" value="{{ request('date') }}"
                           class="border text-white rounded px-3 py-1.5 text-sm focus:outline-none w-40 cursor-pointer [&::-webkit-calendar-picker-indicator]:filter [&::-webkit-calendar-picker-indicator]:invert" style="background:#0F0A04; border-color:#2D1F0A;">
                    <button type="submit" class="border text-white px-3 py-1.5 rounded text-xs font-bold uppercase transition hover:text-amber-400" style="background:#1A1106; border-color:#2D1F0A;">Filtrer</button>
                    @if(request('date'))
                        <a href="{{ route('coiffeur.espace') }}" class="text-red-400 hover:text-red-300 text-xs font-bold uppercase px-2 transition">X Effacer</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-stone-300 whitespace-nowrap">
                    <thead class="text-stone-400 uppercase text-xs tracking-wider border-b" style="background:#0F0A04; border-color:rgba(212,168,67,.08);">
                        <tr>
                            <th class="px-6 py-4 font-medium">Date & Heure</th>
                            <th class="px-6 py-4 font-medium">Client</th>
                            <th class="px-6 py-4 font-medium">Type de coupe</th>
                            <th class="px-6 py-4 font-medium">Statut</th>
                            <th class="px-6 py-4 font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-800/30">
                    @forelse($reservations as $r)
                        @php
                            $nomStatut   = optional($r->statut)->nom;
                            $isCancelled = mb_strtolower($nomStatut) === 'annulé';
                        @endphp
                        <tr class="transition {{ $isCancelled ? 'opacity-50' : '' }}">
                            <td class="px-6 py-4 font-medium text-white">{{ \Carbon\Carbon::parse($r->date_heure)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">{{ $r->client->utilisateur->nom ?? '—' }}</td>
                            <td class="px-6 py-4">{{ $r->typeDeCoupe->nom ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full uppercase tracking-wide {{ $isCancelled ? 'badge-red' : '' }}"
                                      style="{{ !$isCancelled ? 'background:rgba(16,185,129,.1); color:#34d399; border:1px solid rgba(16,185,129,.25);' : '' }}">
                                    {{ $nomStatut ?? 'En attente' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($isCancelled)
                                    <form method="POST" action="{{ route('coiffeur.reservations.restaurer', $r->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-amber-400 hover:text-amber-300 border border-amber-400/40 hover:bg-amber-400/10 px-3 py-1 rounded text-xs font-bold transition uppercase tracking-wide">Restaurer dispo</button>
                                    </form>
                                @else
                                    <span class="text-stone-600">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-stone-500 text-lg">Aucune réservation pour cette période.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
