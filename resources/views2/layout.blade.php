<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barber MX - Genève</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="bg-zinc-950 text-gray-200 font-sans min-h-screen flex flex-col selection:bg-yellow-500 selection:text-black">
    @include('components.navbar')
    
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="border-t border-zinc-900 bg-zinc-950 text-center py-8 text-zinc-500 mt-auto">
        <p class="font-medium text-zinc-400">Barber MX Genève</p>
        <p class="text-sm mt-1">&copy; {{ date('Y') }} - Tous droits réservés.</p>
    </footer>
  </body>
</html>