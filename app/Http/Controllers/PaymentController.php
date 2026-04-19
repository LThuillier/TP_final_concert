<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    public function index(Request $request): Response
    {
        $payments = $request->user()
            ->payments()
            ->latest()
            ->get();

        return Inertia::render('Payments/Index', [
            'payments' => $payments,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Payments/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01', 'max:999999.99'],
            'status' => ['nullable', 'string', 'max:255'],
        ]);

        $request->user()->payments()->create([
            'amount' => $validated['amount'],
            'status' => $validated['status'] ?? 'en attente',
        ]);

        return redirect()->route('payments.index');
    }
}
