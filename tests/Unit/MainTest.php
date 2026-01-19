<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;


class MainTest extends TestCase{
    private $user1, $user2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user1 = User::factory()->create([  'is_admin' => 0  ]);
        $this->user2 = User::factory()->create([  'is_admin' => 1  ]);
    }

    public function test_get_sim(): void
    {
        $this->actingAs($this->user1)->withSession(['banned' => false]);
        
        $this->getJson('/api/v1/sim', [
            'phones' => [79273610640]
        ])->assertStatus(200);

        $this->getJson('/api/v1/sim', [
            'contracts_id' => [1, 2]
        ])->assertStatus(200);

        $this->getJson('/api/v1/sim', [
            'groups_id' => [1, 2]
        ])->assertStatus(200);
    }


    public function test_create_contract(): void
    {
        $this->actingAs($this->user1)->withSession(['banned' => false]);
        $this->postJson('/api/v1/contract', [
            'user_id' => 1,
            'description' => 'Описание'
        ])->assertStatus(403);

        
        $this->actingAs($this->user2)->withSession(['banned' => false]);
        $response = $this->postJson('/api/v1/contract', [
            'user_id' => 1,
            'description' => 'Описание'
        ]);
        $response->assertStatus(200)->assertJsonStructure([
            'data'=>[
                'description', 'created_at', 'id',
            ]
        ]);
    }


    public function test_get_contract(): void
    {
        $this->actingAs($this->user1)->withSession(['banned' => false]);
        $response = $this->getJson('/api/v1/contract', [])->assertStatus(403);

        $this->actingAs($this->user2)->withSession(['banned' => false]);
        $response = $this->getJson('/api/v1/contract', []);
        $response->assertStatus(200)->assertJsonStructure([
            'data'=>[
                [ 'description', 'created_at', 'id', ]
            ]
        ]);
    }
}
