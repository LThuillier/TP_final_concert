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
        // Récupère les tickets de l'utilisateur connecté
        $tickets = Ticket::where('user_id', auth()->id())->latest()->get();
        return Inertia::render('Tickets/Index', ['tickets' => $tickets]);
    }

    public function create()
    {
        return Inertia::render('Tickets/Create');
    }

    public function store(Request $request)
    {
        // 1. On vérifie que les champs sont remplis
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // 2. Configuration du Filtre de gros mots
        $censor = new CensorWords;
        // On ajoute quelques mots interdits pour le test
        $censor->addDictionary(['pirate', 'arnaque', 'nul']); 
        
        $texteAControler = $validated['title'] . ' ' . $validated['description'];
        $resultatFiltre = $censor->censorString($texteAControler);

        // 3. Si le texte a été censuré (il contient des ***)
        if (strpos($resultatFiltre['clean'], '*') !== false) {
            // On renvoie l'utilisateur en arrière avec un message d'erreur
            return back()->withErrors(['description' => 'Attention : Votre billet contient des mots inappropriés ou interdits.']);
        }

        // 4. Si tout est propre, on sauvegarde le ticket !
        $request->user()->tickets()->create($validated);

        return redirect()->route('tickets.index');
    }
}