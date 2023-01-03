<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    private array $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'email' => 'tes@tes.com',
            'password' => 'password',
            'name' => 'tes name'
        ];
    }

    public function test_register_valid()
    {
        $response = $this->postJson('/api/register', $this->data);

        $this->user = User::whereName($this->data['name'])->latest()->firstOrFail();

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_login_valid()
    {
        $user = User::factory()->create();

        $credentials = ['email' => 'admin@gmail.com', 'password' => 'password'];

        $response = $this->postJson('api/login', $credentials);

        $response->assertStatus(200);
    }


}
