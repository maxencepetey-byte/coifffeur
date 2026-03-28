@extends('layout')

@section('title', 'Modifier mon profil professionnel')

@section('content')
<div class="max-w-6xl mx-auto my-10">
    
    {{-- En-tête de la page --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 border-b border-zinc-800 pb-6 gap-4">
        <h1 class="text-3xl font-extrabold text-white uppercase tracking-wide">Modifier mon profil</h1>
        <a href="{{ route('coiffeur.espace') }}" class="px-5 py-2.5 bg-zinc-900 border border-zinc-700 text-white rounded-md hover:border-yellow-500 hover:text-yellow-500 transition shadow-sm font-medium text-sm uppercase tracking-wide flex items-center gap-2">
            <span>&larr;</span> Retour à l'espace
        </a>
    </div>

    {{-- Messages flash (Succès / Erreurs) --}}
    @if(session('success'))
      <div class="mb-8 p-4 bg-green-500/10 border border-green-500 text-green-400 rounded-md text-sm font-medium">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="bg-red-500/10 border border-red-500 text-red-500 p-5 rounded-md mb-8 text-sm font-medium">
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Formulaire Principal --}}
    <form method="POST" action="{{ route('coiffeur.profil.mettreAJour') }}" class="space-y-8">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- Colonne 1 : Informations personnelles --}}
            <div class="bg-zinc-900 rounded-xl shadow-xl border border-zinc-800 p-8">
                <h3 class="text-xl font-bold text-white uppercase tracking-wide mb-8 flex items-center">
                    <span class="w-2 h-6 bg-yellow-500 mr-3 rounded-sm"></span> Informations personnelles
                </h3>

                <div class="space-y-6">
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Prénom</label>
                        <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $coiffeur->utilisateur->prenom) }}" 
                               class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                    </div>

                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Nom</label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $coiffeur->utilisateur->nom) }}" 
                               class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Adresse e-mail</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $coiffeur->utilisateur->email) }}" 
                               class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                    </div>

                    <div class="pt-4 mt-4 border-t border-zinc-800/50">
                        <label for="password" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Nouveau mot de passe</label>
                        <input type="password" name="password" id="password" 
                               class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600" 
                               placeholder="Laisser vide pour ne pas changer">
                    </div>
                </div>
            </div>

            {{-- Colonne 2 : Types de coupe et tarifs --}}
            <div class="bg-zinc-900 rounded-xl shadow-xl border border-zinc-800 p-8 flex flex-col">
                <h3 class="text-xl font-bold text-white uppercase tracking-wide mb-8 flex items-center">
                    <span class="w-2 h-6 bg-yellow-500 mr-3 rounded-sm"></span> Mes Prestations & Tarifs
                </h3>

                {{-- Tableau des coupes --}}
                <div class="overflow-y-auto flex-grow max-h-[400px] mb-6 pr-2 custom-scrollbar">
                    <table class="w-full text-left text-sm text-gray-300">
                        <thead class="bg-zinc-950 text-zinc-400 uppercase text-xs tracking-wider sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-4 font-medium text-center border-b border-zinc-800 rounded-tl-md">✓</th>
                                <th class="px-4 py-4 font-medium border-b border-zinc-800">Prestation</th>
                                <th class="px-4 py-4 font-medium border-b border-zinc-800 rounded-tr-md">Prix (CHF)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800/50">
                            @foreach($allTypes as $type)
                                @php
                                    $pivot = $coiffeur->typesDeCoupes->firstWhere('id', $type->id)?->pivot;
                                    $checked = isset($pivot);
                                @endphp
                                <tr class="hover:bg-zinc-800/50 transition group">
                                    <td class="px-4 py-3 text-center">
                                        <input type="checkbox"
                                               name="types_de_coupe[]"
                                               value="{{ $type->id }}"
                                               class="w-4 h-4 text-yellow-500 bg-zinc-950 border-zinc-700 rounded focus:ring-yellow-500 focus:ring-offset-zinc-900 cursor-pointer"
                                               {{ $checked ? 'checked' : '' }}>
                                    </td>
                                    <td class="px-4 py-3 font-medium text-white group-hover:text-yellow-500 transition">{{ $type->nom }}</td>
                                    <td class="px-4 py-3">
                                        <input type="number"
                                               name="prix[{{ $type->id }}]"
                                               placeholder="0.00"
                                               step="0.01"
                                               min="0"
                                               value="{{ old('prix.'.$type->id, $pivot->prix ?? '') }}"
                                               class="w-28 bg-zinc-950 border border-zinc-700 text-white rounded px-3 py-2 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-700">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Ajout d'un nouveau type --}}
                <div class="mt-auto pt-6 border-t border-zinc-800">
                    <label for="nouveau_type" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Créer une nouvelle prestation</label>
                    <input type="text" name="nouveau_type" id="nouveau_type" 
                           class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600" 
                           placeholder="Ex : Tresses plaquées, Soin profond...">
                    <p class="text-xs text-zinc-500 mt-2">Ce type sera ajouté à la base de données s'il n'existe pas encore.</p>
                </div>
            </div>
        </div>

        {{-- Bouton de soumission central --}}
        <div class="flex justify-center mt-12">
            <button type="submit" class="bg-yellow-500 text-black font-extrabold py-4 px-12 rounded-md hover:bg-yellow-600 transition duration-300 shadow-[0_0_15px_rgba(234,179,8,0.2)] hover:scale-105 uppercase tracking-wider text-lg">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

{{-- Petit script CSS pour styliser la barre de défilement du tableau (optionnel mais plus joli) --}}
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #18181b; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #eab308; }
</style>
@endsection