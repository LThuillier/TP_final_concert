<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Snipe\BanBuilder\CensorWords;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->latest()->get();

        return Inertia::render('Tickets/Index', ['tickets' => $tickets]);
    }

    public function create()
    {
        return Inertia::render('Tickets/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $censor = new CensorWords;

        // addFromArray adds words directly, unlike addDictionary (which expects files)
        $censor->addFromArray(['pirate', 'arnaque', 'nul']);

        $textToCheck = $validated['title'] . ' ' . ($validated['description'] ?? '');

        // fullWords=true avoids false positives on sub-strings such as "annulation"
        $filtered = $censor->censorString($textToCheck, true);

        if (!empty($filtered['matched'])) {
            return back()->withErrors([
                'description' => 'Attention : votre billet contient des mots inappropries ou interdits.',
            ]);
        }

        $request->user()->tickets()->create($validated);

        return redirect()->route('tickets.index');
    }
}
