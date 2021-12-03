<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FollowingTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCannotFollowHimself()
    {
        $follower = User::factory()->create();
        $response = $this->actingAs($follower)->postJson("api/users/$follower->id/follow");
        $response->assertStatus(403);
    }

    public function testUserCannotFollowUserAlreadyFollowedByHim()
    {
        $follower = User::factory()->create();
        $followed = User::factory()->create();
        $follower->follows()->attach($followed);
        $response = $this->actingAs($follower)->postJson("api/users/$followed->id/follow");
        $response->assertStatus(403);
    }

    public function testUserCannotFollowNotExistUser()
    {
        $follower   = User::factory()->create();
        $followed   = User::factory()->create();
        $notExistId = $followed->id + 1;
        $response   = $this->actingAs($follower)->postJson("api/users/$notExistId/follow");
        $response->assertStatus(404);
    }

    public function testUserCanFollowUser()
    {
        $follower = User::factory()->create();
        $followed = User::factory()->create();
        $response = $this->actingAs($follower)->postJson("api/users/$followed->id/follow");
        $response->assertStatus(201);
    }


}
