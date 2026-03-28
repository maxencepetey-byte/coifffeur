<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoiffeurController;

// Page d’accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Inscription (formulaire + traitement)
Route::view('/register', 'inscription')->name('register');
Route::view('/inscription', 'inscription')->name('inscription.form');
Route::post('/inscription', [InscriptionController::class, 'store'])->name('inscription.store');

// Connexion et déconnexion
Route::get('/login',  [ConnexionController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ConnexionController::class, 'login'])->name('login.post');
Route::post('/logout',[ConnexionController::class, 'logout'])->name('logout');


// ==========================================
// ESPACE CLIENT
// ==========================================
Route::prefix('client')->name('client.')->group(function () {
    
    // Dashboard et réservations
    Route::get('espace', [ClientController::class, 'espaceClient'])->name('espace');
    Route::post('reserver', [ClientController::class, 'reserver'])->name('reserver');
    Route::patch('reservations/{reservation}/annuler', [ClientController::class,'annulerReservation'])->name('reservations.annuler');
    Route::post('/supprimer-compte', [ClientController::class, 'supprimerCompte'])->name('supprimer_compte');

    // Profil Client 
    Route::get('profile/edit',    [ClientController::class, 'editProfile'])->name('profile.edit');
    Route::patch('profile',       [ClientController::class, 'updateProfile'])->name('profile.update');
    Route::delete('profile',      [ClientController::class, 'destroyProfile'])->name('profile.destroy');
});


// ==========================================
// ESPACE COIFFEUR
// ==========================================
Route::prefix('coiffeur')->name('coiffeur.')->group(function () {
    
    // Dashboard et disponibilités
    Route::get('espace', [CoiffeurController::class, 'dashboard'])->name('espace');
    Route::get('dashboard', [CoiffeurController::class, 'dashboard'])->name('dashboard');
    Route::post('disponibilites', [CoiffeurController::class, 'storeDisponibilite'])->name('disponibilites.store');
    Route::delete('disponibilites/{dispo}', [CoiffeurController::class, 'destroyDisponibilite'])->name('disponibilites.destroy');
    
    // Réservations
    Route::patch('reservations/{reservation}/valider', [CoiffeurController::class, 'validerReservation'])->name('reservations.valider');
    Route::patch('reservations/{reservation}/restaurer',[CoiffeurController::class, 'restaurerDisponibilite'])->name('reservations.restaurer');
    
    // Profil Coiffeur
    Route::get('profil/modifier', [CoiffeurController::class, 'modifierProfil'])->name('profil.modifier');   
    Route::patch('profil', [CoiffeurController::class, 'mettreAJourProfil'])->name('profil.mettreAJour');
});