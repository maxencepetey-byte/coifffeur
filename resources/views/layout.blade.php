<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barber MX - Genève</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
      /* ── Palette africaine ── */
      :root {
        --gold:    #D4A843;
        --gold-lt: #F0C96A;
        --brown:   #1A1208;
        --warm:    #2B1D0E;
        --amber:   #B8860B;
      }

      body { font-family: 'Inter', sans-serif; background-color: #0F0A04; }

      /* Fond global avec texture subtile */
      body::before {
        content: '';
        position: fixed; inset: 0; z-index: -1; pointer-events: none;
        background:
          radial-gradient(ellipse 80% 50% at 50% 0%, rgba(212,168,67,.06) 0%, transparent 60%),
          radial-gradient(ellipse 60% 40% at 80% 100%, rgba(180,100,20,.04) 0%, transparent 50%);
      }

      /* Titres en Cinzel (feeling kente / royal africain) */
      h1, h2, h3, .font-extrabold, .uppercase.tracking-wide { font-family: 'Cinzel', serif; }

      /* Scrollbar custom */
      ::-webkit-scrollbar { width: 6px; height: 6px; }
      ::-webkit-scrollbar-track { background: #1A1208; }
      ::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 4px; }
      ::-webkit-scrollbar-thumb:hover { background: var(--gold-lt); }

      /* Transitions globales fluides */
      a, button, input, select { transition: all .25s ease; }

      /* Glow doré pour les boutons primaires */
      .btn-gold {
        background: linear-gradient(135deg, #D4A843 0%, #F0C96A 50%, #D4A843 100%);
        background-size: 200% 200%;
        color: #0F0A04;
        font-family: 'Cinzel', serif;
        letter-spacing: .1em;
        animation: shimmer 3s ease infinite;
        box-shadow: 0 0 20px rgba(212,168,67,.3), inset 0 1px 0 rgba(255,255,255,.2);
      }
      .btn-gold:hover {
        box-shadow: 0 0 35px rgba(212,168,67,.55), inset 0 1px 0 rgba(255,255,255,.3);
        transform: translateY(-1px) scale(1.02);
      }
      @keyframes shimmer {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
      }

      /* Cards avec border dorée animée au hover */
      .card-african {
        background: linear-gradient(145deg, #1C1106 0%, #120D05 100%);
        border: 1px solid #2D1F0A;
        border-radius: 16px;
        transition: border-color .3s ease, box-shadow .3s ease, transform .3s ease;
      }
      .card-african:hover {
        border-color: rgba(212,168,67,.5);
        box-shadow: 0 8px 40px rgba(212,168,67,.08), 0 2px 12px rgba(0,0,0,.4);
        transform: translateY(-3px);
      }

      /* Ligne décorative dorée */
      .gold-line { display: inline-block; width: 3px; background: linear-gradient(180deg, var(--gold-lt), var(--gold)); border-radius: 2px; margin-right: 12px; }

      /* Badge statut */
      .badge-gold { background: rgba(212,168,67,.12); color: #D4A843; border: 1px solid rgba(212,168,67,.3); }
      .badge-red  { background: rgba(220,38,38,.12);  color: #f87171; border: 1px solid rgba(220,38,38,.25); }

      /* Input focus ring doré */
      input:focus, select:focus {
        outline: none;
        border-color: var(--gold) !important;
        box-shadow: 0 0 0 2px rgba(212,168,67,.2);
      }

      /* Table rows alternées */
      tbody tr:nth-child(even) { background: rgba(255,255,255,.015); }
      tbody tr:hover           { background: rgba(212,168,67,.04) !important; }

      /* Fade-in animation on page load */
      @keyframes fadeUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
      main > * { animation: fadeUp .5s ease both; }
      main > *:nth-child(2) { animation-delay:.1s; }
      main > *:nth-child(3) { animation-delay:.2s; }

      /* Navbar glass effect */
      nav { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }

      /* Footer kente pattern subtil */
      footer {
        background: linear-gradient(180deg, transparent, #0F0A04);
        border-top: 1px solid rgba(212,168,67,.15);
        position: relative;
      }
      footer::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
      }
    </style>
  </head>
  <body class="bg-[#0F0A04] text-stone-200 min-h-screen flex flex-col selection:bg-amber-400 selection:text-stone-950">
    @include('components.navbar')
    
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="text-center py-10 text-stone-500 mt-auto">
        <p class="font-medium text-stone-400 tracking-widest uppercase text-sm" style="font-family:'Cinzel',serif;">Barber MX Genève</p>
        <p class="text-xs mt-2 text-stone-600">&copy; {{ date('Y') }} — Tous droits réservés.</p>
    </footer>
  </body>
</html>
