<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Cart::class, 'cart');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        $cartWithRelations = [];
        foreach ($carts as  $cart) {
            $cartWithRelations[] = $cart->menus->load('food')->load('menuable')->load('carts')[0];
        }

        return response()->json(CartResource::collection($cartWithRelations));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('menu_id', $request->menu_id)
            ->first();

        $menu = Menu::find($request->menu_id);

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity,
            ]);
            $menu->carts()->attach($cart->id);
        } else {
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
            ]);
        }

        $cart = $cart->menus->load('food')->load('menuable')->load('carts');

        return response()->json(CartResource::collection($cart), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Cart $cart)
    {
        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }

        $cart->update([
            'quantity' => $cart->quantity + 1,
        ]);

        $cart = $cart->menus->load('food')->load('menuable')->load('carts');
        return response()->json(CartResource::collection($cart), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Cart $cart)
    {
        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }

        if ($cart->quantity == 1) {
            return response()->json(CartResource::collection($cart));
        }

        $cart->update([
            'quantity' => $cart->quantity - 1,
        ]);

        $cart = $cart->menus->load('food')->load('menuable')->load('carts');
        return response()->json(CartResource::collection($cart));

    }
}
