<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    private array $product;
    private User $user;

    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Product::factory()->make()->toArray();
        $this->user = User::first();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_show_list_products()
    {
        $this->actingAs($this->user);

        $response = $this->getJson('/api/products');
        $response->assertStatus(200);
    }

    public function test_create_success()
    {
        $this->actingAs($this->user);

        $response = $this->postJson('/api/products', $this->product);
        $response->assertCreated();
    }

    public function test_invalid_create()
    {
        $user = User::first();
        $this->actingAs($user);

        $this->product['name'] = '';

        $response = $this->postJson('/api/products', $this->product);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertInvalid(['name']);
    }

    public function test_valid_update()
    {
        $this->actingAs($this->user);

        $this->product['name'] = 'for update';
        $firstProduct = Product::firstOrFail();
        $response = $this->putJson('/api/products/' . $firstProduct->id, $this->product);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_invalid_update()
    {
        $this->actingAs($this->user);

        $this->product['name'] = null;

        $firstProduct = Product::firstOrFail();

        $response = $this->putJson('/api/products/' . $firstProduct->id, $this->product);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertInvalid(['name']);
    }

}
