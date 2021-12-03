<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class TweetingTest extends TestCase
{
    use RefreshDatabase;

    public function testCannotTweetWithoutAuthenticated()
    {
        $data = [
            'content' => 'content dummy'
        ];
        $response = $this->postJson("api/tweets",$data);
        $response->assertStatus(401);
    }

    public function testCannotTweetWithoutContent()
    {
        $user     = User::factory()->create();
        $data = [];
        $response = $this->actingAs($user)->postJson("api/tweets",$data);
        $response->assertStatus(422);
    }

    public function testCannotTweetWithContentBiggerThan140()
    {
        $user     = User::factory()->create();
        $data = [
            'content' => Str::random(141)
        ];
        $response = $this->actingAs($user)->postJson("api/tweets",$data);
        $response->assertStatus(422);
    }

    public function testCanTweet()
    {
        $user     = User::factory()->create();
        $data = [
            'content' => 'content dummy'
        ];
        $response = $this->actingAs($user)->postJson("api/tweets",$data);
        $response->assertStatus(201);
    }
}
