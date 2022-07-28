<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreCartRequest;
use App\Models\Restaurant;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Notification;

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
        $cart = Cart::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();
        $cartItems = $cart->cartItems->load('menu');

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
        $restaurantId = Menu::find($request->menu_id)
            ->load('menuable')->menuable->id;

        $cart = Cart::where('user_id', auth()->id())
            ->where('restaurant_id', $restaurantId)
            ->where('status', 'pending')
            ->first();

        $cart ?? $cart = Cart::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $restaurantId
        ]);
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('menu_id', $request->menu_id)
            ->first();

        DB::transaction(function () use ($request, $cart, $cartItem, $restaurantId) {
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
        });

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
        if (auth()->id() != $cartItem->cart->user_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        DB::transaction(function () use ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + 1,
            ]);
        });
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
        if (auth()->id() != $cartItem->cart->user_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        DB::transaction(function () use ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity - 1,
                ]);
            } else {
                $cartItem->delete();
                if ($cartItem->cart->cartItems->isEmpty()) {
                    $cartItem->cart->delete();
                }
            }
        });

        $cart = $cartItem->cart;
        $cart = $cart->cartItems->load('menu');
        return response()->json(CartResource::collection($cart), 200);
    }

    /**
     * Delete Cart.
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Restaurant $restaurant)
    {
        DB::transaction(function () use ($restaurant) {
            $cart = Cart::where('user_id', auth()->id())
                ->where('restaurant_id', $restaurant->id)
                ->where('status', 'pending')
                ->first();

            if (!$cart) {
                return response()->json([
                    'message' => 'Cart not found'
                ], 404);
            }

            $cart->cartItems->each->delete();
            $cart->delete();
        });
        return response()->json([
            'message' => 'Cart deleted'
        ], 200);
    }
}
