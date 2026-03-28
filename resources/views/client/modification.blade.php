@extends('layout')

@section('content')
<div class="max-w-xl mx-auto p-10 rounded-2xl shadow-2xl my-10 relative overflow-hidden" style="background: linear-gradient(145deg, #1C1106, #120D05); border: 1px solid rgba(212,168,67,.2);">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-px" style="background: linear-gradient(90deg, transparent, #D4A843, transparent);"></div>

    <h2 class="text-2xl font-extrabold text-white mb-8 pb-4 uppercase tracking-wide" style="font-family:'Cinzel',serif; border-bottom: 1px solid rgba(212,168,67,.15);">Modifier mon profil</h2>

    @if(session('success'))
      <div class="mb-8 p-4 bg-emerald-900/20 border border-emerald-600 text-emerald-400 rounded-md text-sm font-medium">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('client.profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="nom" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Nom</label>
            <input id="nom" name="nom" type="text"
                   value="{{ old('nom', $utilisateur->nom) }}"
                   class="w-full border text-white rounded-md px-4 py-3 transition text-sm"
                   style="background:#0F0A04; border-color:#2D1F0A;"
                   required>
            @error('nom')<p class="text-red-400 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="prenom" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Prénom</label>
            <input id="prenom" name="prenom" type="text"
                   value="{{ old('prenom', $utilisateur->prenom) }}"
                   class="w-full border text-white rounded-md px-4 py-3 transition text-sm"
                   style="background:#0F0A04; border-color:#2D1F0A;"
                   required>
            @error('prenom')<p class="text-red-400 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="email" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Email</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $utilisateur->email) }}"
                   class="w-full border text-white rounded-md px-4 py-3 transition text-sm"
                   style="background:#0F0A04; border-color:#2D1F0A;"
                   required>
            @error('email')<p class="text-red-400 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center mt-10 pt-6 gap-4" style="border-top: 1px solid rgba(212,168,67,.1);">
            <button type="submit"
                    class="btn-gold w-full sm:w-auto px-8 py-3 rounded-md font-bold uppercase tracking-widest text-sm" style="font-family:'Cinzel',serif;">
                Enregistrer
            </button>
    </form>
            
            <form method="POST" action="{{ route('client.profile.destroy') }}"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement votre compte ?');"
                  class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-transparent border border-red-700/40 text-red-400 font-bold rounded-md hover:bg-red-900/20 transition uppercase tracking-widest text-xs" style="font-family:'Cinzel',serif;">
                    Supprimer mon compte
                </button>
            </form>
        </div>
</div>
@endsection
