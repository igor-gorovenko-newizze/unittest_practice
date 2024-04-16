<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_redirects_to_products()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@ex.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' =>  'john@ex.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('products');
    }

    public function test_unauthenticated_user_cannot_access_product()
    {
        $response = $this->get('/products');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
}
