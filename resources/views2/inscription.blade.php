@extends('layout')

@section('content')

<section class="flex items-center justify-center py-10">
  <div class="w-full max-w-2xl bg-zinc-900 p-10 rounded-2xl shadow-2xl border border-zinc-800">
    <h2 class="text-3xl font-extrabold text-white mb-8 text-center border-b border-zinc-800 pb-6 uppercase tracking-wide">Créer un compte</h2>

    @if ($errors->any())
      <div class="bg-red-500/10 border border-red-500 text-red-500 p-5 rounded-md mb-8 text-sm">
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="bg-green-500/10 border border-green-500 text-green-400 p-5 rounded-md mb-8 text-sm font-medium text-center">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('inscription.store') }}" class="space-y-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="nom" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Nom</label>
          <input type="text" name="nom" id="nom" required placeholder="Votre nom" value="{{ old('nom') }}" class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600">
        </div>
        <div>
          <label for="prenom" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Prénom</label>
          <input type="text" name="prenom" id="prenom" required placeholder="Votre prénom" value="{{ old('prenom') }}" class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="date_naissance" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Date de naissance</label>
          <input type="date" name="date_naissance" id="date_naissance" required value="{{ old('date_naissance') }}" class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition [&::-webkit-calendar-picker-indicator]:filter [&::-webkit-calendar-picker-indicator]:invert">
        </div>
        <div>
          <label for="telephone" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Téléphone</label>
          <input type="tel" name="telephone" id="telephone" required placeholder="+41 79 123 45 67" value="{{ old('telephone') }}" class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600">
        </div>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Adresse e-mail</label>
        <input type="email" name="email" id="email" required placeholder="exemple@mail.com" value="{{ old('email') }}" class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600">
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="mot_de_passe" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Mot de passe</label>
          <input type="password" name="mot_de_passe" id="mot_de_passe" required placeholder="••••••••" class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600">
        </div>
        <div>
          <label for="mot_de_passe_confirmation" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Confirmer</label>
          <input type="password" name="mot_de_passe_confirmation" id="mot_de_passe_confirmation" required placeholder="••••••••" class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600">
        </div>
      </div>

      <button type="submit" class="w-full bg-yellow-500 text-black font-bold py-3.5 rounded-md hover:bg-yellow-600 transition duration-300 shadow-[0_0_10px_rgba(234,179,8,0.2)] uppercase tracking-wide mt-4">
        S’inscrire
      </button>
    </form>

    <p class="text-center text-zinc-500 mt-8 text-sm">
      Déjà un compte ? 
      <a href="{{ route('login') }}" class="text-yellow-500 hover:text-yellow-400 font-medium transition hover:underline">Se connecter</a>
    </p>
  </div>
</section>

@endsection