<nav class="bg-[#100B03]/95 border-b border-[#D4A843]/20 shadow-[0_4px_24px_rgba(0,0,0,.6)] sticky top-0 z-50">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="text-2xl font-extrabold text-white tracking-widest uppercase group" style="font-family:'Cinzel',serif;">
        BARBER <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-500 group-hover:from-amber-200 group-hover:to-amber-400 transition duration-300">MX</span>
    </a>
    
    <div class="space-x-6 text-sm font-medium flex items-center">
      <a href="{{ route('home') }}" class="text-stone-300 hover:text-amber-400 transition duration-300 uppercase tracking-wider text-xs">Accueil</a>

      {{-- Si l'utilisateur est CONNECTÉ --}}
      @if(Session::has('user_id'))
          
          {{-- Menu spécifique COIFFEUR --}}
          @if(Session::get('user_role') === 'coiffeur')
              <a href="{{ route('coiffeur.espace') }}" class="text-stone-300 hover:text-amber-400 transition duration-300 uppercase tracking-wider text-xs">Mon Planning</a>
              
              <a href="{{ route('coiffeur.profil.modifier') }}" class="text-amber-400 border border-amber-400/40 bg-amber-400/8 px-4 py-2 rounded-md hover:bg-amber-400 hover:text-stone-950 transition duration-300 uppercase tracking-wider text-xs" style="font-family:'Cinzel',serif;">
                  Mon Profil
              </a>

          {{-- Menu spécifique CLIENT --}}
          @elseif(Session::get('user_role') === 'client')
              <a href="{{ route('client.espace') }}" class="text-stone-300 hover:text-amber-400 transition duration-300 uppercase tracking-wider text-xs">Mon Espace</a>
          @endif

          {{-- Bouton de déconnexion --}}
          <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
              @csrf
              <button type="submit" class="bg-red-900/20 text-red-400 border border-red-700/40 px-4 py-2 rounded-md font-bold hover:bg-red-700/30 hover:text-red-300 transition duration-300 uppercase tracking-wider text-xs">
                  Déconnexion
              </button>
          </form>

      @else
          <a href="{{ route('register') }}" class="text-stone-300 hover:text-amber-400 transition duration-300 uppercase tracking-wider text-xs">Inscription</a>
          <a href="{{ route('login') }}" class="btn-gold px-5 py-2 rounded-md font-bold uppercase tracking-wider text-xs shadow-lg">
              Se connecter
          </a>
      @endif
    </div>
  </div>
</nav>
