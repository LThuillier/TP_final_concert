<?php

use App\Http\Controllers\Api\TicketApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/open-tickets', [TicketApiController::class, 'openTickets'])->name('api.open-tickets');
    Route::get('/closed-tickets', [TicketApiController::class, 'closedTickets'])->name('api.closed-tickets');
    Route::get('/users/{email}/tickets', [TicketApiController::class, 'userTickets'])->name('api.users.tickets');
    Route::get('/stats', [TicketApiController::class, 'stats'])->name('api.stats');
});
