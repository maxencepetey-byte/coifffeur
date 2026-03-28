<?php
// Page d’accueil
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoiffeurController;

Route::get('/', fn() => 'OK route /');

Route::get('/', [HomeController::class, 'index'])
     ->name('home');

// Inscription (formulaire + traitement)
Route::view('/register', 'inscription')->name('register');
Route::view('/inscription', 'inscription')->name('inscription.form');
Route::post('/inscription', [InscriptionController::class, 'store'])
     ->name('inscription.store');

Route::get('/login',  [ConnexionController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ConnexionController::class, 'login'])          ->name('login.post');
Route::post('/logout',[ConnexionController::class, 'logout'])         ->name('logout');



// Espace client
Route::prefix('client')
     ->name('client.')
     ->group(function () {
         // GET  /client/espace
         Route::get('espace', [ClientController::class, 'espaceClient'])
              ->name('espace');

         // POST /client/reserver
         Route::post('reserver', [ClientController::class, 'reserver'])
              ->name('reserver');

         // PATCH /client/reservations/{reservation}/annuler
         Route::patch('reservations/{reservation}/annuler', [ClientController::class,'annulerReservation'])
             ->name('reservations.annuler');
          
          Route::post('/client/supprimer-compte', [ClientController::class, 'supprimerCompte'])
               ->name('supprimer_compte');

     });


// Espace coiffeur
Route::prefix('coiffeur')
     ->name('coiffeur.')
     ->group(function () {
         // GET    /coiffeur/espace
         Route::get('espace', [CoiffeurController::class, 'dashboard'])
              ->name('espace');

          Route::get('dashboard', [CoiffeurController::class, 'dashboard'])
              ->name('dashboard');

         // POST   /coiffeur/disponibilites
         Route::post('disponibilites', [CoiffeurController::class, 'storeDisponibilite'])
              ->name('disponibilites.store');

         // DELETE /coiffeur/disponibilites/{dispo}
         Route::delete('disponibilites/{dispo}', [CoiffeurController::class, 'destroyDisponibilite'])
              ->name('disponibilites.destroy');

          Route::patch('reservations/{reservation}/valider', [CoiffeurController::class, 'validerReservation'])
               ->name('reservations.valider');

          Route::patch(
             'reservations/{reservation}/restaurer',[CoiffeurController::class, 'restaurerDisponibilite'])
             ->name('reservations.restaurer');

          Route::get('profil/modifier', [CoiffeurController::class, 'modifierProfil'])
               ->name('profil.modifier');   

          Route::patch('profil', [CoiffeurController::class, 'mettreAJourProfil'])
               ->name('profil.mettreAJour');

     });