<nav class="bg-zinc-900 border-b border-zinc-800 shadow-md sticky top-0 z-50">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="text-2xl font-extrabold text-white tracking-widest uppercase">
        BARBER <span class="text-yellow-500">MX</span>
    </a>
    
    <div class="space-x-6 text-sm font-medium flex items-center">
      <a href="{{ route('home') }}" class="text-gray-300 hover:text-yellow-500 transition duration-300 uppercase tracking-wide">Accueil</a>

      {{-- Si l'utilisateur est CONNECTÉ --}}
      @if(Session::has('user_id'))
          
          {{-- Menu spécifique COIFFEUR --}}
          @if(Session::get('user_role') === 'coiffeur')
              <a href="{{ route('coiffeur.espace') }}" class="text-gray-300 hover:text-yellow-500 transition duration-300 uppercase tracking-wide">Mon Planning</a>
              
              {{-- LE BOUTON PROFIL CORRIGÉ --}}
              <a href="{{ route('coiffeur.profil.modifier') }}" class="text-yellow-500 border border-yellow-500/50 bg-yellow-500/10 px-4 py-2 rounded-md hover:bg-yellow-500 hover:text-black transition duration-300 uppercase tracking-wide">
                  Mon Profil
              </a>

          {{-- Menu spécifique CLIENT --}}
          @elseif(Session::get('user_role') === 'client')
              <a href="{{ route('client.espace') }}" class="text-gray-300 hover:text-yellow-500 transition duration-300 uppercase tracking-wide">Mon Espace</a>
          @endif

          {{-- Bouton de déconnexion commun à tous les connectés --}}
          <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
              @csrf
              <button type="submit" class="bg-red-500/10 text-red-500 border border-red-500/50 px-4 py-2 rounded-md font-bold hover:bg-red-500 hover:text-white transition duration-300 uppercase tracking-wide text-xs">
                  Déconnexion
              </button>
          </form>

      {{-- Si l'utilisateur est VISITEUR (non connecté) --}}
      @else
          <a href="{{ route('register') }}" class="text-gray-300 hover:text-yellow-500 transition duration-300 uppercase tracking-wide">Inscription</a>
          <a href="{{ route('login') }}" class="bg-yellow-500 text-black px-5 py-2 rounded-md font-bold hover:bg-yellow-600 transition duration-300 hover:scale-105 uppercase tracking-wide shadow-lg">
              Se connecter
          </a>
      @endif
    </div>
  </div>
</nav>