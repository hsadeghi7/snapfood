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
    }

    public function test_set_cart()
    {
        $response = $this->post(
            'api/buyer/carts',
            [
                'menu_id' => 1,
                'quantity' => 50
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json',
                'user_id' => 2

            ]
        );
        $response->assertStatus(200);
    }


    // public function test_get_cart()
    // {
    //     $response = $this->get('/api/buyer/carts');
    //     $response->assertStatus(200);
    // }

    // public function test_add_item_to_cart()
    // {
    //     $response = $this->put('/api/buyer/carts', []);
    //     $response->assertStatus(200);
    // }

    // public function test_remove_item_from_cart()
    // {
    //     $cart = Cart::firstOrCreate(
    //         ['user_id' => 2],
    //         ['menu_id' => 1, 'quantity' => 2]
    //     );

    //     $response = $this->delete(
    //         '/api/buyer/carts/' . $cart->id,
    //         [],
    //         [
    //             'Authorization' => 'Bearer ' . $this->token,
    //             'Accept' => 'application/json',
    //             'user_id' => 2

    //         ]
    //     );

    //     $response->assertStatus(200);
    //     $this->assertDatabaseHas('carts', ['id' => $cart->id, 'quantity' => $cart->quantity - 1]);
    // }


    // public function test_remove_item_from_cart()
    // {
    //     $id = Cart::all()->last()->id + 1;
    //     $response = $this->delete(
    //         '/api/buyer/carts/' . $id,
    //         [],
    //         [
    //             'Authorization' => 'Bearer ' . $this->token,
    //             'Accept' => 'application/json',
    //             'user_id' => 2

    //         ]
    //     );
    //     $response->assertStatus(404);

    // }

    //     DB::beginTransaction();
    // try {
    // DB::insert(...);
    // DB::insert(...);
    // DB::insert(...);
    // DB::commit();
    // // all good
    // } catch (\Exception $e) {
    // DB::rollback();
    // // something went wrong
    // }

    // public function FunctionName()
    // {
    //     DB::transaction(function () {
    //         DB::update('update users set votes = 1');

    //         DB::delete('delete from posts');
    //     });
    // }
}
