<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cart;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartTest extends TestCase
{
    use DatabaseTransactions;

    protected $token = '';
    public function setUp(): void
    {
        parent::setUp();

        $response = $this->post('api/buyer/login', [
            'email' => 'buyer@gmail.com',
            'password' => 'password'
        ]);

        $response->assertJsonStructure(['user_token']);
        $this->token = $response->json()['user_token'];
        
        $response = $this->post(
            'api/buyer/carts',
            [
                'menu_id' => 1,
                'quantity' => 50
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json',
            ]
        );
    }


    public function test_get_cart()
    {
        $response = $this->get(
            '/api/buyer/carts',
            [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json',
            ]
        );
        $response->assertStatus(200);
    }


    public function test_remove_cart()
    {

        $response = $this->delete(
            '/api/buyer/carts/' ,
            [],
            [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json',
            ]
        );

        $response->assertStatus(200);
    }



   
}
