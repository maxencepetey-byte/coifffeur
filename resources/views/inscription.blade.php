@extends('layout')

@section('content')

<section class="flex items-center justify-center py-10">
  <div class="w-full max-w-2xl p-10 rounded-2xl shadow-2xl relative overflow-hidden" style="background: linear-gradient(145deg, #1C1106, #120D05); border: 1px solid rgba(212,168,67,.2);">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-48 h-px" style="background: linear-gradient(90deg, transparent, #D4A843, transparent);"></div>

    <p class="text-center text-amber-400/60 text-xs tracking-[0.3em] uppercase mb-3" style="font-family:'Cinzel',serif;">✦ Rejoignez-nous ✦</p>
    <h2 class="text-3xl font-extrabold text-white mb-8 text-center border-b pb-6 uppercase tracking-wide" style="font-family:'Cinzel',serif; border-color:rgba(212,168,67,.15);">Créer un compte</h2>

    @if ($errors->any())
      <div class="bg-red-900/20 border border-red-700/40 text-red-400 p-5 rounded-md mb-8 text-sm">
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="bg-emerald-900/20 border border-emerald-600 text-emerald-400 p-5 rounded-md mb-8 text-sm font-medium text-center">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('inscription.store') }}" class="space-y-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="nom" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Nom</label>
          <input type="text" name="nom" id="nom" required placeholder="Votre nom" value="{{ old('nom') }}" class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm" style="background:#0F0A04; border-color:#2D1F0A;">
        </div>
        <div>
          <label for="prenom" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Prénom</label>
          <input type="text" name="prenom" id="prenom" required placeholder="Votre prénom" value="{{ old('prenom') }}" class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm" style="background:#0F0A04; border-color:#2D1F0A;">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="date_naissance" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Date de naissance</label>
          <input type="date" name="date_naissance" id="date_naissance" required value="{{ old('date_naissance') }}" class="w-full border text-white rounded-md px-4 py-3 transition text-sm [&::-webkit-calendar-picker-indicator]:filter [&::-webkit-calendar-picker-indicator]:invert" style="background:#0F0A04; border-color:#2D1F0A;">
        </div>
        <div>
          <label for="telephone" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Téléphone</label>
          <input type="tel" name="telephone" id="telephone" required placeholder="+41 79 123 45 67" value="{{ old('telephone') }}" class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm" style="background:#0F0A04; border-color:#2D1F0A;">
        </div>
      </div>

      <div>
        <label for="email" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Adresse e-mail</label>
        <input type="email" name="email" id="email" required placeholder="exemple@mail.com" value="{{ old('email') }}" class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm" style="background:#0F0A04; border-color:#2D1F0A;">
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="mot_de_passe" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Mot de passe</label>
          <input type="password" name="mot_de_passe" id="mot_de_passe" required placeholder="••••••••" class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm" style="background:#0F0A04; border-color:#2D1F0A;">
        </div>
        <div>
          <label for="mot_de_passe_confirmation" class="block text-xs font-medium text-stone-400 mb-2 uppercase tracking-widest" style="font-family:'Cinzel',serif;">Confirmer</label>
          <input type="password" name="mot_de_passe_confirmation" id="mot_de_passe_confirmation" required placeholder="••••••••" class="w-full border text-white rounded-md px-4 py-3 transition placeholder-stone-600 text-sm" style="background:#0F0A04; border-color:#2D1F0A;">
        </div>
      </div>

      <button type="submit" class="btn-gold w-full font-bold py-3.5 rounded-md uppercase tracking-widest mt-4 text-sm" style="font-family:'Cinzel',serif;">
        S'inscrire
      </button>
    </form>

    <p class="text-center text-stone-500 mt-8 text-sm">
      Déjà un compte ? 
      <a href="{{ route('login') }}" class="text-amber-400 hover:text-amber-300 font-medium transition hover:underline">Se connecter</a>
    </p>
  </div>
</section>

@endsection
