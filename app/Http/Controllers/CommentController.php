<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\ReplyStoreRequest;
use App\Models\Restaurant;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReplyStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyStoreRequest $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);
        if ($restaurant) {
            Comment::create([
                'user_id' => auth()->id(),
                'restaurant_id' => $request->restaurant_id,
                'parent_id' => $request->comment_id,
                'body' => $request->body,
                'cart_id' => $request->cart_id,
            ]);
            return redirect()->back()->with('message', 'Comment replied successfully');
        }
        return abort(403, 'Unauthorized action');
    }

    /**
     * Show the form for updating the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment, $action)
    {

        $comment->update([
            'is_approve' => $action == 'approve' ? true : false,
        ]);

        $message = $action == 'approve' ? 'Comment approved successfully' : 'Comment disapproved successfully';

        return redirect()->back()->with('message', $message);
    }
}
