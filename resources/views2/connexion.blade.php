@extends('layout')

@section('content')

<section class="flex items-center justify-center min-h-[70vh]">
  <div class="w-full max-w-md bg-zinc-900 p-10 rounded-2xl shadow-2xl border border-zinc-800">
    <h2 class="text-3xl font-extrabold text-white mb-8 text-center uppercase tracking-wide">Connexion</h2>

    @if(session('error'))
      <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-md mb-6 text-sm text-center font-medium">
          {{ session('error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Adresse e-mail</label>
        <input type="email" name="email" id="email" required placeholder="ex: contact@mail.com"
               class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-400 mb-2 uppercase tracking-wide">Mot de passe</label>
        <input type="password" name="password" id="password" required placeholder="••••••••"
               class="w-full bg-zinc-950 border border-zinc-800 text-white rounded-md px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition placeholder-zinc-600">
      </div>

      <button type="submit" class="w-full bg-yellow-500 text-black font-bold py-3.5 rounded-md hover:bg-yellow-600 transition duration-300 shadow-[0_0_10px_rgba(234,179,8,0.2)] uppercase tracking-wide mt-2">
        Se connecter
      </button>
    </form>

    <p class="text-center text-zinc-500 mt-8 text-sm">
      Pas encore de compte ? 
      <a href="{{ route('register') }}" class="text-yellow-500 hover:text-yellow-400 font-medium transition hover:underline">Créer un compte</a>
    </p>
  </div>
</section>

@endsection
