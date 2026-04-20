<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::findOrCreate('admin');
        Role::findOrCreate('client');

        $admin = User::query()->updateOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('adminpassword'),
        ]);
        $admin->syncRoles(['admin']);

        $user = User::query()->updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => Hash::make('password'),
        ]);
        $user->syncRoles(['client']);

        Ticket::query()->firstOrCreate([
            'title' => 'Pass Festival 1 jour',
            'user_id' => $user->id,
        ], [
            'description' => 'Billet de demonstration pour les tests manuels.',
            'status' => 'disponible',
        ]);

        Payment::query()->firstOrCreate([
            'user_id' => $user->id,
            'amount' => 49.90,
        ], [
            'status' => 'en attente',
        ]);
    }
}
