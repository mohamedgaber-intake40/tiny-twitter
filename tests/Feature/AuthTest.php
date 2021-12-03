<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testCannotLoginWithWrongCredentials()
    {
        $user     = User::factory()->create();
        $data     = [
            'email'    => $user->email,
            'password' => "123456A"
        ];
        $response = $this->postJson('api/login', $data);
        $response->assertStatus(422);
    }

    public function testCanLoginWithRightCredentials()
    {
        $user     = User::factory()->create();
        $data     = [
            'email'    => $user->email,
            'password' => "123456"
        ];
        $response = $this->postJson('api/login', $data);
        $response->assertStatus(200);
    }

    public function testCannotLoginAfter5WrongTries()
    {
        $user     = User::factory()->create();
        $data     = [
            'email'    => $user->email,
            'password' => "1234567"
        ];
        for ($i = 1; $i <= 5; $i++) {
            $response = $this->postJson('api/login', $data);
        }
        $data     = [
            'email'    => $user->email,
            'password' => "123456"
        ];
        $response = $this->postJson('api/login', $data);

        $response->assertStatus(429);
    }

    public function testCannotRegisterWithExistsEmail()
    {
        $user     = User::factory()->create();
        $data     = [
            'email'                 => $user->email,
            'name'                  => 'mohamed',
            'password'              => '123456',
            'password_confirmation' => '123456',
            'image'                 => UploadedFile::fake()->create('image.jpg')->size(1000),
            'date_of_birth'         => '2021-5-4'
        ];
        $response = $this->postJson('api/register', $data);
        $response->assertStatus(422);
    }

    public function testCanRegister()
    {
        $data     = [
            'email'                 => "mohamed@test.com",
            'name'                  => 'mohamed',
            'password'              => '123456',
            'password_confirmation' => '123456',
            'image'                 => UploadedFile::fake()->create('image.jpg')->size(1000),
            'date_of_birth'         => '2021-5-4'
        ];
        $response = $this->postJson('api/register', $data);
        $response->assertStatus(201);
    }

    public function testCannotRegisterWithoutName()
    {
        $data     = [
            'email'                 => "mohamed@test.com",
            'password'              => '123456',
            'password_confirmation' => '123456',
            'image'                 => UploadedFile::fake()->create('image.jpg')->size(1000),
            'date_of_birth'         => '2021-5-4'
        ];
        $response = $this->postJson('api/register', $data);
        $response->assertStatus(422);
    }

    public function testCannotRegisterWithoutEmail()
    {
        $data     = [
            'name'                  => 'mohamed',
            'password'              => '123456',
            'password_confirmation' => '123456',
            'image'                 => UploadedFile::fake()->create('image.jpg')->size(1000),
            'date_of_birth'         => '2021-5-4'
        ];
        $response = $this->postJson('api/register', $data);
        $response->assertStatus(422);
    }

    public function testCannotRegisterWithoutImage()
    {
        $data     = [
            'email'                 => "mohamed@test.com",
            'name'                  => 'mohamed',
            'password'              => '123456',
            'password_confirmation' => '123456',
            'date_of_birth'         => '2021-5-4'
        ];
        $response = $this->postJson('api/register', $data);
        $response->assertStatus(422);
    }

    public function testCannotRegisterWithoutDate()
    {
        $data     = [
            'email'                 => "mohamed@test.com",
            'name'                  => 'mohamed',
            'password'              => '123456',
            'password_confirmation' => '123456',
            'image'                 => UploadedFile::fake()->create('image.jpg')->size(1000),
        ];
        $response = $this->postJson('api/register', $data);
        $response->assertStatus(422);
    }

    public function testCannotRegisterWithImageBiggerThan10240()
    {
        $data     = [
            'email'                 => "mohamed@test.com",
            'name'                  => 'mohamed',
            'password'              => '123456',
            'password_confirmation' => '123456',
            'image'                 => UploadedFile::fake()->create('image.jpg')->size(10241),
            'date_of_birth'         => '2021-5-4'
        ];
        $response = $this->postJson('api/register', $data);
        $response->assertStatus(422);
    }


}
