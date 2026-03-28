@extends('layout')

@section('content')

<section class="text-center py-24 bg-zinc-900 rounded-2xl mb-16 shadow-2xl border border-zinc-800 relative overflow-hidden">
  <div class="relative z-10 px-4">
      <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight uppercase">
          Bienvenue chez <span class="text-yellow-500">Barber MX</span>
      </h1>
      <p class="text-xl md:text-2xl text-gray-400 mb-10 max-w-3xl mx-auto font-light">
          Style, précision et élégance pour l’homme moderne.
      </p>
      <a href="{{ route('login') }}" class="inline-block bg-yellow-500 text-black px-10 py-4 rounded-md font-bold text-lg hover:bg-yellow-600 transition shadow-[0_0_15px_rgba(234,179,8,0.3)] hover:scale-105 uppercase tracking-wider">
          Réserver maintenant
      </a>
  </div>
</section>

<section class="mb-20">
  <h2 class="text-3xl font-bold text-white mb-10 border-l-4 border-yellow-500 pl-4 uppercase tracking-wide">Nos Types de Coupe</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($typesDeCoupes as $type)
      <div class="bg-zinc-900 p-8 rounded-xl border border-zinc-800 hover:border-yellow-500 transition duration-300 group shadow-lg">
        <h3 class="text-2xl font-bold text-white group-hover:text-yellow-500 transition mb-3">{{ $type->nom }}</h3>
        @if(!empty($type->description))
          <p class="text-gray-400 leading-relaxed">{{ $type->description }}</p>
        @endif
      </div>
    @endforeach
  </div>
</section>

<section class="mb-20">
  <h2 class="text-3xl font-bold text-white mb-10 border-l-4 border-yellow-500 pl-4 uppercase tracking-wide">Notre Équipe</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($coiffeurs as $coiffeur)
      <div class="bg-zinc-900 p-8 rounded-xl text-center border border-zinc-800 hover:-translate-y-2 transition duration-300 shadow-lg">
        <div class="w-24 h-24 mx-auto bg-zinc-950 rounded-full mb-6 flex items-center justify-center text-yellow-500 text-3xl font-bold border-2 border-zinc-800">
            {{ substr($coiffeur->utilisateur->nom, 0, 1) }}
        </div>
        <h3 class="text-xl font-bold text-white uppercase">{{ $coiffeur->utilisateur->nom }}</h3>
        <p class="text-sm text-yellow-500 mt-2 font-medium tracking-wide">
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

<section class="text-center py-12 bg-zinc-900 rounded-xl border border-zinc-800 shadow-lg">
  <a href="{{ route('login') }}" class="inline-block bg-white text-black px-8 py-3 rounded-md font-bold hover:bg-gray-200 transition uppercase tracking-wide shadow-md">
      Se connecter
  </a>
  <p class="mt-6 text-gray-400">
    Nouveau client ? <a href="{{ route('register') }}" class="text-yellow-500 hover:text-yellow-400 hover:underline font-medium transition">Créer un compte</a>
  </p>
</section>

@endsection
