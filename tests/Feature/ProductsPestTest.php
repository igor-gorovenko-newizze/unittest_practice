<?php

use App\Models\Product;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);
});

test('homepage containts empty table', function () {
    $this->actingAs($this->user)
        ->get('/products')
        ->assertStatus(200)
        ->assertSee('No products found');
});

test('homepage containts non empty table', function () {
    $product = Product::create([
        'title' => 'Product 1',
        'price' => 100,
    ]);

    $this->actingAs($this->user)
        ->get('/products')
        ->assertStatus(200)
        ->assertDontSee('No products found')
        ->assertSee('Product 1')
        ->assertViewHas('products', function ($collection) use ($product) {
            return $collection->contains($product);
        });
});

test('create product successful', function () {
    $product = [
        'title' => 'Product 1',
        'price' => '100',
    ];

     $this->actingAs($this->admin)
         ->post('/products', $product)
         ->assertRedirect('products');

    $this->assertDatabaseHas('products', $product);

    $lastProduct = Product::latest()->first();
    expect($lastProduct->title)->toBe($product['title']);
    expect($lastProduct->price)->toBe($product['price']);
});
