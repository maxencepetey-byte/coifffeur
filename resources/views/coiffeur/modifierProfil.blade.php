@extends('layout')

@section('title', 'Modifier mon profil professionnel')

@section('content')
<div class="max-w-6xl mx-auto my-10">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 pb-6 gap-4" style="border-bottom:1px solid rgba(212,168,67,.12);">
        <h1 class="text-3xl font-extrabold text-white uppercase tracking-wide" style="font-family:'Cinzel',serif;">Modifier mon profil</h1>
        <a href="{{ route('coiffeur.espace') }}" class="px-5 py-2.5 border text-white rounded-md transition shadow-sm font-medium text-xs uppercase tracking-widest flex items-center gap-2 hover:text-amber-400" style="background:#1C1106; border-color:rgba(212,168,67,.25); font-family:'Cinzel',serif;">
            <span>&larr;</span> Retour à l'espace
        </a>
    </div>

    @if(session('success'))
      <div class="mb-8 p-4 bg-emerald-900/20 border border-emerald-600 text-emerald-400 rounded-md text-sm font-medium">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="bg-red-900/20 border border-red-700/40 text-red-400 p-5 rounded-md mb-8 text-sm font-medium">
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('coiffeur.profil.mettreAJour') }}" class="space-y-8">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- Colonne 1 --}}
            <div class="rounded-xl shadow-xl p-8 card-african">
                <h3 class="text-xl font-bold text-white uppercase tracking-wide mb-8 flex items-center" style="font-family:'Cinzel',serif;">
                    <span class="gold-line h-6"></span> Informations personnelles
                </h3>

                <div class="space-y-6">
                    <div>
                        <label for="prenom" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Prénom</label>
                        <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $coiffeur->utilisateur->prenom) }}" 
                               class="w-full border text-white rounded-md px-4 py-3 transition text-sm" style="background:#0F0A04; border-color:#2D1F0A;">
                    </div>

                    <div>
                        <label for="nom" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Nom</label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $coiffeur->utilisateur->nom) }}" 
                               class="w-full border text-white rounded-md px-4 py-3 transition text-sm" style="background:#0F0A04; border-color:#2D1F0A;">
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Adresse e-mail</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $coiffeur->utilisateur->email) }}" 
                               class="w-full border text-white rounded-md px-4 py-3 transition text-sm" style="background:#0F0A04; border-color:#2D1F0A;">
                    </div>

                    <div class="pt-4 mt-4" style="border-top:1px solid rgba(212,168,67,.08);">
                        <label for="password" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Nouveau mot de passe</label>
                        <input type="password" name="password" id="password" 
                               class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm" 
                               style="background:#0F0A04; border-color:#2D1F0A;"
                               placeholder="Laisser vide pour ne pas changer">
                    </div>
                </div>
            </div>

            {{-- Colonne 2 --}}
            <div class="rounded-xl shadow-xl p-8 flex flex-col card-african">
                <h3 class="text-xl font-bold text-white uppercase tracking-wide mb-8 flex items-center" style="font-family:'Cinzel',serif;">
                    <span class="gold-line h-6"></span> Mes Prestations & Tarifs
                </h3>

                <div class="overflow-y-auto flex-grow max-h-[400px] mb-6 pr-2 custom-scrollbar">
                    <table class="w-full text-left text-sm text-stone-300">
                        <thead class="text-stone-400 uppercase text-xs tracking-wider sticky top-0 z-10" style="background:#0F0A04;">
                            <tr>
                                <th class="px-4 py-4 font-medium text-center border-b" style="border-color:rgba(212,168,67,.08);">✓</th>
                                <th class="px-4 py-4 font-medium border-b" style="border-color:rgba(212,168,67,.08);">Prestation</th>
                                <th class="px-4 py-4 font-medium border-b" style="border-color:rgba(212,168,67,.08);">Prix (CHF)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-800/30">
                            @foreach($allTypes as $type)
                                @php
                                    $pivot = $coiffeur->typesDeCoupes->firstWhere('id', $type->id)?->pivot;
                                    $checked = isset($pivot);
                                @endphp
                                <tr class="transition group">
                                    <td class="px-4 py-3 text-center">
                                        <input type="checkbox"
                                               name="types_de_coupe[]"
                                               value="{{ $type->id }}"
                                               class="w-4 h-4 bg-stone-950 border-stone-700 rounded cursor-pointer"
                                               style="accent-color: #D4A843;"
                                               {{ $checked ? 'checked' : '' }}>
                                    </td>
                                    <td class="px-4 py-3 font-medium text-white group-hover:text-amber-400 transition">{{ $type->nom }}</td>
                                    <td class="px-4 py-3">
                                        <input type="number"
                                               name="prix[{{ $type->id }}]"
                                               placeholder="0.00"
                                               step="0.01"
                                               min="0"
                                               value="{{ old('prix.'.$type->id, $pivot->prix ?? '') }}"
                                               class="w-28 border text-white rounded px-3 py-2 text-sm transition placeholder-stone-700" style="background:#0F0A04; border-color:#2D1F0A;">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-auto pt-6" style="border-top:1px solid rgba(212,168,67,.1);">
                    <label for="nouveau_type" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Créer une nouvelle prestation</label>
                    <input type="text" name="nouveau_type" id="nouveau_type" 
                           class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm" 
                           style="background:#0F0A04; border-color:#2D1F0A;"
                           placeholder="Ex : Tresses plaquées, Soin profond...">
                    <p class="text-xs text-stone-500 mt-2">Ce type sera ajouté à la base de données s'il n'existe pas encore.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-12">
            <button type="submit" class="btn-gold font-extrabold py-4 px-12 rounded-md uppercase tracking-widest text-lg" style="font-family:'Cinzel',serif;">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #0F0A04; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #3f2d0a; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #D4A843; }
</style>
@endsection
