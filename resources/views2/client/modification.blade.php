@extends('layout')

@section('content')
<div class="max-w-xl mx-auto p-10 bg-zinc-900 rounded-2xl shadow-2xl border border-zinc-800 my-10">
    <h2 class="text-2xl font-extrabold text-white mb-8 border-b border-zinc-800 pb-4 uppercase tracking-wide">Modifier mon profil</h2>

    @if(session('success'))
      <div class="mb-8 p-4 bg-green-500/10 border border-green-500 text-green-400 rounded-md text-sm font-medium">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('client.profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="nom" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Nom</label>
            <input id="nom" name="nom" type="text"
                   value="{{ old('nom', $utilisateur->nom) }}"
                   class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition"
                   required>
            @error('nom')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="prenom" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Prénom</label>
            <input id="prenom" name="prenom" type="text"
                   value="{{ old('prenom', $utilisateur->prenom) }}"
                   class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition"
                   required>
            @error('prenom')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Email</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $utilisateur->email) }}"
                   class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition"
                   required>
            @error('email')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center mt-10 pt-6 border-t border-zinc-800 gap-4">
            <button type="submit"
                    class="w-full sm:w-auto px-8 py-3 bg-yellow-500 text-black font-bold rounded-md hover:bg-yellow-600 transition uppercase tracking-wide">
                Enregistrer
            </button>
    </form>
            
            <form method="POST" action="{{ route('client.profile.destroy') }}"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement votre compte ?');"
                  class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-transparent border border-red-500/50 text-red-500 font-bold rounded-md hover:bg-red-500/10 transition uppercase tracking-wide text-sm">
                    Supprimer mon compte
                </button>
            </form>
        </div>
</div>
@endsection