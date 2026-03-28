@extends('layout')

@section('content')

<div class="mb-10">
    <h1 class="text-3xl font-bold text-white uppercase tracking-wide mb-2">Espace Professionnel</h1>
    <p class="text-zinc-400">Gérez votre planning et vos rendez-vous.</p>
</div>

{{-- Message de succès --}}
@if(session('success'))
    <div class="bg-green-500/10 border border-green-500 text-green-400 p-4 rounded-md mb-8 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-12">
    
    {{-- Colonne de gauche : Formulaire + Dispos --}}
    <div class="xl:col-span-1 space-y-8">
        
        {{-- Formulaire de création de disponibilités --}}
        <div class="bg-zinc-900 rounded-xl shadow-xl border border-zinc-800 p-6">
            <h2 class="text-lg font-bold text-white uppercase tracking-wide mb-6 border-b border-zinc-800 pb-3">Ajouter une disponibilité</h2>
            <form method="POST" action="{{ route('coiffeur.disponibilites.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="date" class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wide">Date :</label>
                    <input type="date" id="date" name="date" required class="w-full bg-zinc-950 border border-zinc-700 text-white rounded px-3 py-2 text-sm focus:outline-none focus:border-yellow-500 transition [&::-webkit-calendar-picker-indicator]:filter [&::-webkit-calendar-picker-indicator]:invert">
                    @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="periode" class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wide">Période :</label>
                    <select id="periode" name="periode" required class="w-full bg-zinc-950 border border-zinc-700 text-white rounded px-3 py-2 text-sm focus:outline-none focus:border-yellow-500 transition cursor-pointer">
                        <option value="">-- Choisir --</option>
                        <option value="morning">Matinée (08:00–12:00)</option>
                        <option value="afternoon">Après-midi (13:00–17:00)</option>
                        <option value="full">Journée (08:00–17:00)</option>
                    </select>
                    @error('periode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-yellow-500 text-black font-bold py-2.5 rounded hover:bg-yellow-600 transition uppercase tracking-wide text-sm mt-2">
                    Ajouter
                </button>
            </form>
        </div>

        {{-- Tableau des disponibilités --}}
        <div class="bg-zinc-900 rounded-xl shadow-xl border border-zinc-800 overflow-hidden">
            <h2 class="text-lg font-bold text-white uppercase tracking-wide p-6 border-b border-zinc-800 bg-zinc-950/50">Mes disponibilités</h2>
            <div class="overflow-x-auto max-h-[400px]">
                <table class="w-full text-left text-sm text-gray-300 whitespace-nowrap">
                    <thead class="bg-zinc-950 text-zinc-400 uppercase text-xs sticky top-0">
                        <tr>
                            <th class="px-5 py-3 font-medium border-b border-zinc-800">Début</th>
                            <th class="px-5 py-3 font-medium border-b border-zinc-800">Fin</th>
                            <th class="px-5 py-3 font-medium border-b border-zinc-800">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50">
                    @forelse($disponibilites as $dispo)
                        <tr class="hover:bg-zinc-800/30 transition">
                            <td class="px-5 py-3 text-yellow-500">{{ \Carbon\Carbon::parse($dispo->debut)->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3 text-yellow-500">{{ \Carbon\Carbon::parse($dispo->fin  )->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('coiffeur.disponibilites.destroy', $dispo) }}" onsubmit="return confirm('Supprimer cette disponibilité ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-400 text-xs uppercase font-bold tracking-wide">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-8 text-center text-zinc-500 italic">Aucune disponibilité définie</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Colonne de droite : Calendrier & Réservations --}}
    <div class="xl:col-span-2 space-y-8">
        <div class="bg-zinc-900 rounded-xl shadow-xl border border-zinc-800 overflow-hidden">
            <div class="p-6 border-b border-zinc-800 flex flex-col sm:flex-row justify-between items-center gap-4 bg-zinc-950/50">
                <h2 class="text-lg font-bold text-white uppercase tracking-wide">Planning des réservations</h2>
                
                <form method="GET" action="{{ route('coiffeur.espace') }}" class="flex items-center gap-2">
                    <input type="date" name="date" value="{{ request('date') }}"
                           class="bg-zinc-950 border border-zinc-700 text-white rounded px-3 py-1.5 text-sm focus:outline-none focus:border-yellow-500 w-40 cursor-pointer [&::-webkit-calendar-picker-indicator]:filter [&::-webkit-calendar-picker-indicator]:invert">
                    <button type="submit" class="bg-zinc-700 hover:bg-zinc-600 text-white px-3 py-1.5 rounded text-xs font-bold uppercase transition">Filtrer</button>
                    @if(request('date'))
                        <a href="{{ route('coiffeur.espace') }}" class="text-red-500 hover:text-red-400 text-xs font-bold uppercase px-2 transition">X Effacer</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300 whitespace-nowrap">
                    <thead class="bg-zinc-950 text-zinc-400 uppercase text-xs tracking-wider border-b border-zinc-800">
                        <tr>
                            <th class="px-6 py-4 font-medium">Date & Heure</th>
                            <th class="px-6 py-4 font-medium">Client</th>
                            <th class="px-6 py-4 font-medium">Type de coupe</th>
                            <th class="px-6 py-4 font-medium">Statut</th>
                            <th class="px-6 py-4 font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50">
                    @forelse($reservations as $r)
                        @php
                            $nomStatut   = optional($r->statut)->nom;
                            $isCancelled = mb_strtolower($nomStatut) === 'annulé';
                        @endphp
                        <tr class="hover:bg-zinc-800/30 transition {{ $isCancelled ? 'opacity-50 bg-red-950/10' : '' }}">
                            <td class="px-6 py-4 font-medium text-white">{{ \Carbon\Carbon::parse($r->date_heure)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">{{ $r->client->utilisateur->nom ?? '—' }}</td>
                            <td class="px-6 py-4">{{ $r->typeDeCoupe->nom ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full uppercase tracking-wide {{ $isCancelled ? 'bg-red-500/10 text-red-500 border border-red-500/20' : 'bg-green-500/10 text-green-500 border border-green-500/20' }}">
                                    {{ $nomStatut ?? 'En attente' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($isCancelled)
                                    <form method="POST" action="{{ route('coiffeur.reservations.restaurer', $r->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-yellow-500 hover:text-yellow-400 border border-yellow-500/50 hover:bg-yellow-500/10 px-3 py-1 rounded text-xs font-bold transition uppercase tracking-wide">Restaurer dispo</button>
                                    </form>
                                @else
                                    <span class="text-zinc-600">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-zinc-500 text-lg">Aucune réservation pour cette période.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection