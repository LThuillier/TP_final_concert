<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_store_ticket_when_text_is_clean(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->post(route('tickets.store'), [
            'title' => 'Pass festival 3 jours',
            'description' => 'Billet officiel du concert.',
        ]);

        $response->assertRedirect(route('tickets.index'));

        $this->assertDatabaseHas('tickets', [
            'title' => 'Pass festival 3 jours',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_cannot_store_ticket_with_banned_word(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->from(route('tickets.create'))->post(route('tickets.store'), [
            'title' => 'Offre arnaque',
            'description' => 'Texte interdit.',
        ]);

        $response
            ->assertRedirect(route('tickets.create'))
            ->assertSessionHasErrors('description');

        $this->assertSame(0, Ticket::count());
    }
}
