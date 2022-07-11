<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\CartItem;

class CartController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Cart::class, 'cart');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        $cartItems = $cart->cartItems;
        $cartItems->load('menu');
        return response()->json(CartResource::collection($cartItems));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCartRequest $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        $cart ?? $cart = Cart::create(['user_id' => auth()->id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('menu_id', $request->menu_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity,
            ]);
        }

        $cart = $cart->cartItems->load('menu');
        return response()->json(CartResource::collection($cart), 200);
    }

    /**
     * AddItem the specified resource in cartItems.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartItem  $cart
     * @return \Illuminate\Http\JsonResponse
     */
    public function addItem(CartItem $cartItem)
    {
        if (!$cartItem) {
            return response()->json([
                'message' => 'CartItem not found'
            ], 404);
        }

        $cartItem->update([
            'quantity' => $cartItem->quantity + 1,
        ]);

        $cart = $cartItem->cart;
        $cart = $cart->cartItems->load('menu');
        return response()->json(CartResource::collection($cart), 200);
    }

    /**
     * RemoveItem the specified resource in cartItems.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartItem  $cart
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeItem(CartItem $cartItem)
    {
        if (!$cartItem) {
            return response()->json([
                'message' => 'CartItem not found'
            ], 404);
        }

        if ($cartItem->quantity > 1) {
            $cartItem->update([
                'quantity' => $cartItem->quantity - 1,
            ]);
        } else {
            $cartItem->forceDelete();
        }

        $cart = $cartItem->cart;
        $cart = $cart->cartItems->load('menu');
        return response()->json(CartResource::collection($cart), 200);
    }

    /**
     * Delete Cart.
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }
        $cart->cartItems->each->forceDelete();
        $cart->forceDelete();
        return response()->json([
            'message' => 'Cart deleted'
        ], 200);
    }

    /** 
     * Pay the Cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function pay()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }

        $cartItems = $cart->cartItems->load('menu');
        $totalPayment = 0;

        $cartItems->each(function ($cartItem) use (&$totalPayment) {
            $totalPayment += $cartItem->menu->food->price * $cartItem->menu->coupon * $cartItem->quantity;
        });

        $cart->delete();
        return response()->json([
            'message' => 'Cart Payed',
            'totalPayment' => $totalPayment
        ], 200);
    }
}
