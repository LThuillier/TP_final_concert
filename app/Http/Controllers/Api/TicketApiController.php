<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class TicketApiController extends Controller
{
    public function openTickets(): JsonResponse
    {
        $tickets = Ticket::query()
            ->where('status', 'disponible')
            ->latest()
            ->get();

        return response()->json([
            'data' => $tickets,
        ]);
    }

    public function closedTickets(): JsonResponse
    {
        $tickets = Ticket::query()
            ->where('status', '!=', 'disponible')
            ->latest()
            ->get();

        return response()->json([
            'data' => $tickets,
        ]);
    }

    public function userTickets(string $email): JsonResponse
    {
        $user = User::query()->where('email', $email)->firstOrFail();

        $tickets = $user->tickets()->latest()->get();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'data' => $tickets,
        ]);
    }

    public function stats(): JsonResponse
    {
        $ticketsByStatus = Ticket::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $paymentByStatus = Payment::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return response()->json([
            'tickets' => [
                'total' => Ticket::count(),
                'by_status' => $ticketsByStatus,
            ],
            'payments' => [
                'total' => Payment::count(),
                'by_status' => $paymentByStatus,
            ],
            'users' => [
                'total' => User::count(),
            ],
        ]);
    }
}
