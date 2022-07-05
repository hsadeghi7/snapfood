<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->carts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $cart = new Cart;
        $cart->user_id = auth()->id();
        $cart->save();
        $menu = Menu::find($request->menu_id);
        for ($i = 0; $i < $request->quantity; $i++) {
            $menu->carts()->attach($cart->id);
        }

        return response()->json([
            'message' => 'Successfully added to cart'
        ], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        return response()->json([
            'cart-' . $cart->id => $cart->menus,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateCartRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $menu = Menu::find($request->menu_id);
        $cart->menus()->detach($menu->id);

        for ($i = 0; $i < $request->quantity; $i++) {
            $menu->carts()->attach($cart->id);
        }

        return response()->json([
            'message' => 'Successfully updated cart',
            'cart' => $cart,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->menus()->detach();
        $cart->forceDelete();

        return response()->json([
            'message' => 'Successfully deleted cart',
        ], 200);
    }

    public function pay(Cart $cart)
    {
        $total_price = 0;
        
        foreach ($cart->menus as $menu) {
            $total_price += $menu->food->price* $menu->coupon;
            
        }
        
        $cart->total_price = $total_price;
        $cart->is_pay = true;
        $cart->save();

        $cart->delete();

        return response()->json([
            'message' => 'Successfully paid', 'total_price' =>$total_price
        ], 200);
    }
}
