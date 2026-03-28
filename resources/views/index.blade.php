@extends('layout')

@section('content')

<section class="text-center py-28 rounded-2xl mb-16 shadow-2xl relative overflow-hidden" style="background: linear-gradient(135deg, #1A0F04 0%, #0F0A02 40%, #1E1106 100%); border: 1px solid rgba(212,168,67,.2);">
  {{-- Motif décoratif --}}
  <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse 70% 60% at 50% 0%, rgba(212,168,67,.08) 0%, transparent 70%), radial-gradient(ellipse 40% 40% at 20% 100%, rgba(180,100,20,.06) 0%, transparent 50%);"></div>
  {{-- Ligne dorée supérieure --}}
  <div class="absolute top-0 left-1/2 -translate-x-1/2 w-48 h-px" style="background: linear-gradient(90deg, transparent, #D4A843, transparent);"></div>

  <div class="relative z-10 px-4">
      <p class="text-amber-400/70 text-xs tracking-[0.4em] uppercase mb-4" style="font-family:'Cinzel',serif;">✦ Salon de coiffure africain ✦</p>
      <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight uppercase leading-tight" style="font-family:'Cinzel',serif;">
          Bienvenue chez <br><span class="text-transparent bg-clip-text" style="background: linear-gradient(135deg, #D4A843 0%, #F0C96A 50%, #D4A843 100%);">Barber MX</span>
      </h1>
      <p class="text-xl md:text-2xl text-stone-400 mb-10 max-w-3xl mx-auto font-light tracking-wide">
          Style, précision et élégance pour l'homme moderne.
      </p>
      <a href="{{ route('login') }}" class="inline-block btn-gold px-10 py-4 rounded-md font-bold text-lg uppercase tracking-widest" style="font-family:'Cinzel',serif;">
          Réserver maintenant
      </a>
  </div>

  {{-- Ligne dorée inférieure --}}
  <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-48 h-px" style="background: linear-gradient(90deg, transparent, #D4A843, transparent);"></div>
</section>

<section class="mb-20">
  <h2 class="text-3xl font-bold text-white mb-10 flex items-center uppercase tracking-wide" style="font-family:'Cinzel',serif;">
    <span class="gold-line h-8"></span>Nos Types de Coupe
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($typesDeCoupes as $type)
      <div class="card-african p-8 group">
        <h3 class="text-2xl font-bold text-white group-hover:text-amber-400 transition mb-3" style="font-family:'Cinzel',serif;">{{ $type->nom }}</h3>
        @if(!empty($type->description))
          <p class="text-stone-400 leading-relaxed text-sm">{{ $type->description }}</p>
        @endif
      </div>
    @endforeach
  </div>
</section>

<section class="mb-20">
  <h2 class="text-3xl font-bold text-white mb-10 flex items-center uppercase tracking-wide" style="font-family:'Cinzel',serif;">
    <span class="gold-line h-8"></span>Notre Équipe
  </h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($coiffeurs as $coiffeur)
      <div class="card-african p-8 text-center">
        <div class="w-24 h-24 mx-auto rounded-full mb-6 flex items-center justify-center text-amber-400 text-3xl font-bold" style="background: linear-gradient(135deg, #1E1106, #2D1A08); border: 2px solid rgba(212,168,67,.3); font-family:'Cinzel',serif;">
            {{ substr($coiffeur->utilisateur->nom, 0, 1) }}
        </div>
        <h3 class="text-xl font-bold text-white uppercase" style="font-family:'Cinzel',serif;">{{ $coiffeur->utilisateur->nom }}</h3>
        <p class="text-sm text-amber-400/80 mt-2 font-medium tracking-wide text-xs">
          @if($coiffeur->specialites->isNotEmpty())
            {{ $coiffeur->specialites->pluck('nom')->join(', ') }}
          @else
            Artisan Barbier
          @endif
        </p>
      </div>
    @endforeach
  </div>
</section>

<section class="text-center py-14 rounded-2xl relative overflow-hidden" style="background: linear-gradient(135deg, #1A1208, #120D05); border: 1px solid rgba(212,168,67,.15);">
  <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, #D4A843, transparent);"></div>
  <a href="{{ route('login') }}" class="inline-block btn-gold px-8 py-3 rounded-md font-bold uppercase tracking-widest" style="font-family:'Cinzel',serif;">
      Se connecter
  </a>
  <p class="mt-6 text-stone-400 text-sm">
    Nouveau client ? <a href="{{ route('register') }}" class="text-amber-400 hover:text-amber-300 hover:underline font-medium transition">Créer un compte</a>
  </p>
</section>

@endsection
