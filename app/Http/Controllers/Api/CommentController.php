<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use App\Notifications\CommentSubmitNotifications;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    public function show(Restaurant $restaurant)
    {
        $comment = Comment::where('restaurant_id', $restaurant->id)
            ->with(['user', 'cart', 'cart.restaurant', 'cart.cartItems', 'cart.cartItems.menu.food'])
            ->get();

        return response()->json(['comments' => CommentResource::collection($comment)], 200);
    }

    public function store(StoreCommentRequest $request)
    {
        $request->validated();
        $cart = Cart::find($request->cart_id);
        $userId = $cart->user_id;
        $restaurantId = $cart->restaurant_id;

        if ($userId !== auth()->id) {
            return response()
                ->json(['message' => 'You are not authorized to comment this restaurant'], 401);
        }

        $comment = Comment::create([
            'body' => request('body'),
            'score' => request('score'),
            'user_id' => auth()->id(),
            'cart_id' => $request->cart_id,
            'restaurant_id' => $restaurantId,
        ]);
        Notification::send(auth()->user(), new CommentSubmitNotifications($this->comment));

        return response()->json([
            'message' => 'comment created successfully',
            'comment' => $comment
        ], 200);
    }
}
