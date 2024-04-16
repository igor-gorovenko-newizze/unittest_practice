<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
        $this->admin = $this->createUser(isAdmin: true);
    }

    public function test_homepage_containts_empty_table(): void
    {
        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertSee('No products found');
    }

    public function test_homepage_containts_non_empty_table(): void
    {
        $product = Product::create([
            'title' => 'Product 1',
            'price' => 100,
        ]);

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($collection) use ($product) {
            return $collection->contains($product);
        });
    }

    public function test_paginated_products_table_doesnt_contain_11th_record(): void
    {
        $products = Product::factory(11)->create();
        $lastProduct = $products->last();

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($collection) use ($lastProduct) {
            return $collection->contains($lastProduct);
        });
    }

    public function test_admin_can_see_products_create_button ()
    {
        $response = $this->actingAs($this->admin)->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Create new product');
    }

    public function test_non_admin_cannot_see_products_create_button ()
    {
        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee('Create new product');
    }

    public function test_admin_can_access_product_create_page ()
    {
        $response = $this->actingAs($this->admin)->get('/products/create');

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_product_create_page ()
    {
        $response = $this->actingAs($this->user)->get('/products/create');

        $response->assertStatus(403);
    }

    public function test_create_product_successful()
    {
        $product = [
            'title' => 'Product 1',
            'price' => 100,
        ];

        $request = $this->actingAs($this->admin)->post('/products', $product);

        $request->assertStatus(302);
        $request->assertRedirect('products');

        $this->assertDatabaseHas('products', $product);

        $lastProduct = Product::latest()->first();
        $this->assertEquals($product['title'], $lastProduct->title);
        $this->assertEquals($product['price'], $lastProduct->price);
    }

    public function test_product_edit_contains_correct_value()
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->admin)->get("/products/{$product->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('value="' . $product->title . '"', false);
        $response->assertSee('value="' . $product->price . '"', false);
        $response->assertViewHas('product', $product);
    }

    public function test_product_update_validation_error_redirects_back_to_form()
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->admin)->put("/products/{$product->id}", [
            'title' => '',
            'price' => ''
        ]);

        $response->assertStatus(302);
        $response->assertInvalid(['title', 'price']);
    }

    private function createUser(bool $isAdmin = false): User
    {
        return User::factory()->create([
            'is_admin' => $isAdmin,
        ]);
    }
}
