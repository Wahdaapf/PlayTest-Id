<?php

use App\Models\User;
use App\Models\UserBalance;
use App\Models\Withdraw;
use Illuminate\Foundation\Testing\DatabaseTransactions;

// Use DatabaseTransactions to avoid destroying local database data
uses(DatabaseTransactions::class);

test('xendit webhook marks payout as succeeded', function () {
    // 1. Setup User and Balance
    $user = User::factory()->create();
    $balance = UserBalance::create([
        'id_user' => $user->id,
        'point' => 500,
    ]);

    // 2. Create pending withdrawal
    $withdraw = Withdraw::create([
        'id_user' => $user->id,
        'point' => 150,
        'rupiah' => 10000,
        'metode' => 'gopay',
        'nomor_akun' => '081234567890',
        'status' => 'pending',
        'xendit_payout_id' => 'payout-12345'
    ]);

    // 3. Post webhook payload
    $response = $this->postJson('/xendit/callback', [
        'event' => 'payout.succeeded',
        'data' => [
            'id' => 'payout-12345',
            'reference_id' => 'WD-20260603-' . $withdraw->id,
            'status' => 'SUCCEEDED',
            'amount' => 10000,
        ]
    ]);

    // 4. Assert response and database status
    $response->assertStatus(200);
    expect($withdraw->fresh()->status)->toBe('success');
    expect($balance->fresh()->point)->toBe(500); // no refund because it succeeded
});

test('xendit webhook marks payout as failed and refunds points', function () {
    // 1. Setup User and Balance
    $user = User::factory()->create();
    $balance = UserBalance::create([
        'id_user' => $user->id,
        'point' => 500,
    ]);

    // 2. Create pending withdrawal
    $withdraw = Withdraw::create([
        'id_user' => $user->id,
        'point' => 150,
        'rupiah' => 10000,
        'metode' => 'gopay',
        'nomor_akun' => '081234567890',
        'status' => 'pending',
        'xendit_payout_id' => 'payout-12345'
    ]);

    // 3. Post webhook payload
    $response = $this->postJson('/xendit/callback', [
        'event' => 'payout.failed',
        'data' => [
            'id' => 'payout-12345',
            'reference_id' => 'WD-20260603-' . $withdraw->id,
            'status' => 'FAILED',
            'failure_code' => 'INSUFFICIENT_BALANCE',
            'amount' => 10000,
        ]
    ]);

    // 4. Assert response, database status, and refund
    $response->assertStatus(200);
    expect($withdraw->fresh()->status)->toBe('rejected');
    expect($withdraw->fresh()->catatan)->toContain('INSUFFICIENT_BALANCE');
    expect($balance->fresh()->point)->toBe(650); // 500 + 150 refunded
});
