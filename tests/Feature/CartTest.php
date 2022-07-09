<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{

    public function test_set_cart()
    {

        $response = $this->post('/api/buyer/carts', [
            'menu_id' => 1,
            'quantity' => 1
        ]);

        $response->assertStatus(200);
    }
    public function test_get_cart()
    {
        $response = $this->get('/api/buyer/carts');
        $response->assertStatus(200);
    }

    public function test_add_item_to_cart()
    {
        $response = $this->put('/api/buyer/carts', []);
        $response->assertStatus(200);
    }

    public function test_remove_item_from_cart()
    {
        $response = $this->delete('/api/buyer/carts', []);
        $response->assertStatus(200);
    }
}
