<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_payment(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->post(route('payments.store'), [
            'amount' => '59.90',
            'status' => 'en attente',
        ]);

        $response->assertRedirect(route('payments.index'));

        $this->assertDatabaseHas('payments', [
            'user_id' => $user->id,
            'status' => 'en attente',
        ]);
    }

    public function test_payment_requires_positive_amount(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->post(route('payments.store'), [
            'amount' => '0',
            'status' => 'en attente',
        ]);

        $response->assertSessionHasErrors('amount');

        $this->assertSame(0, Payment::count());
    }
}
