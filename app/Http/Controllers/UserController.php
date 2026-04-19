<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::query()
            ->withCount(['tickets', 'payments'])
            ->latest()
            ->get(['id', 'name', 'email', 'created_at']);

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }
}
