@extends('layout')

@section('content')

<section class="flex items-center justify-center min-h-[70vh]">
  <div class="w-full max-w-md p-10 rounded-2xl shadow-2xl relative overflow-hidden" style="background: linear-gradient(145deg, #1C1106, #120D05); border: 1px solid rgba(212,168,67,.2);">
    {{-- Accent doré haut --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-px" style="background: linear-gradient(90deg, transparent, #D4A843, transparent);"></div>

    <p class="text-center text-amber-400/60 text-xs tracking-[0.3em] uppercase mb-3" style="font-family:'Cinzel',serif;">✦ Accès sécurisé ✦</p>
    <h2 class="text-3xl font-extrabold text-white mb-8 text-center uppercase tracking-wide" style="font-family:'Cinzel',serif;">Connexion</h2>

    @if(session('error'))
      <div class="bg-red-900/20 border border-red-700/40 text-red-400 p-4 rounded-md mb-6 text-sm text-center font-medium">
          {{ session('error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Adresse e-mail</label>
        <input type="email" name="email" id="email" required placeholder="ex: contact@mail.com"
               class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm"
               style="background:#0F0A04; border-color:#2D1F0A;">
      </div>

      <div>
        <label for="password" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Mot de passe</label>
        <input type="password" name="password" id="password" required placeholder="••••••••"
               class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm"
               style="background:#0F0A04; border-color:#2D1F0A;">
      </div>

      <button type="submit" class="btn-gold w-full font-bold py-3.5 rounded-md uppercase tracking-widest mt-2 text-sm" style="font-family:'Cinzel',serif;">
        Se connecter
      </button>
    </form>

    <p class="text-center text-stone-500 mt-8 text-sm">
      Pas encore de compte ? 
      <a href="{{ route('register') }}" class="text-amber-400 hover:text-amber-300 font-medium transition hover:underline">Créer un compte</a>
    </p>
  </div>
</section>

@endsection
