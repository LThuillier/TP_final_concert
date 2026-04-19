<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $tickets = Ticket::query()
        ->latest()
        ->limit(6)
        ->get(['id', 'title', 'description', 'status']);

    if ($tickets->isEmpty()) {
        $tickets = collect([
            [
                'id' => 1,
                'title' => 'Pass Festival 1 jour',
                'description' => 'Acces libre a tous les concerts pendant une journee.',
                'status' => 'disponible',
            ],
            [
                'id' => 2,
                'title' => 'Pass Festival 3 jours',
                'description' => 'Le billet complet pour vivre toute l experience du festival.',
                'status' => 'disponible',
            ],
            [
                'id' => 3,
                'title' => 'Place VIP Scene Principale',
                'description' => 'Zone premium, entree prioritaire et vue privilegiee.',
                'status' => 'disponible',
            ],
            [
                'id' => 4,
                'title' => 'Billet Etudiant',
                'description' => 'Tarif reduit pour les etudiants, sur presentation d un justificatif.',
                'status' => 'disponible',
            ],
            [
                'id' => 5,
                'title' => 'Billet Duo',
                'description' => '2 places a prix preferentiel pour venir en groupe.',
                'status' => 'disponible',
            ],
            [
                'id' => 6,
                'title' => 'Pass Backstage Experience',
                'description' => 'Acces backstage limite avec souvenirs et rencontre equipe.',
                'status' => 'places limitees',
            ],
        ]);
    }

    return Inertia::render('Home', [
        'appName' => config('app.name', 'FestivApp'),
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'tickets' => $tickets,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tickets', TicketController::class)->only(['index', 'create', 'store']);
    Route::resource('payments', PaymentController::class)->only(['index', 'create', 'store']);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

require __DIR__.'/auth.php';
