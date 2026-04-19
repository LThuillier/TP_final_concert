<?php

namespace Tests\Feature\Api;

use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketApiEndpointsTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_open_and_closed_tickets(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        Ticket::query()->create([
            'title' => 'Open ticket',
            'description' => 'Disponible',
            'status' => 'disponible',
            'user_id' => $user->id,
        ]);

        Ticket::query()->create([
            'title' => 'Closed ticket',
            'description' => 'Ferme',
            'status' => 'vendu',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $open = $this->getJson('/api/open-tickets');
        $open->assertOk()->assertJsonCount(1, 'data');

        $closed = $this->getJson('/api/closed-tickets');
        $closed->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_api_returns_user_tickets_and_stats(): void
    {
        $user = User::factory()->create([
            'email' => 'client@example.com',
            'email_verified_at' => now(),
        ]);

        Ticket::query()->create([
            'title' => 'Ticket A',
            'description' => 'Desc',
            'status' => 'disponible',
            'user_id' => $user->id,
        ]);

        Payment::query()->create([
            'amount' => 49.90,
            'status' => 'en attente',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $userTickets = $this->getJson('/api/users/'.rawurlencode($user->email).'/tickets');
        $userTickets
            ->assertOk()
            ->assertJsonPath('user.email', 'client@example.com')
            ->assertJsonCount(1, 'data');

        $stats = $this->getJson('/api/stats');
        $stats
            ->assertOk()
            ->assertJsonPath('tickets.total', 1)
            ->assertJsonPath('payments.total', 1)
            ->assertJsonPath('users.total', 1);
    }
}
