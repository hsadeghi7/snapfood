<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\ReplyStoreRequest;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index()
    {
        $comments = Comment::where('is_approve', 0)->with('restaurant')->paginate(5);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReplyStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyStoreRequest $request)
    {
        $restaurant = Restaurant::where('id', $request->restaurant_id)
            ->where('user_id', auth()->id())->first();

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
     * update the approve status.
     *
     * @param  \App\Models\Comment  $comment
     * @param string $action
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment, $action)
    {
        $restaurant = Restaurant::where('id', $comment->restaurant_id)
            ->where('user_id', auth()->id())->first();
        if ($restaurant) {
            $comment->update([
                'is_approve' => $action == 'approve' ? true : false,
            ]);
            $message = $action == 'approve' ? 'Comment approved successfully' : 'Comment disapproved successfully';
            return redirect()->back()->with('message', $message);
        }
        return abort(403, 'Unauthorized action');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function delete(Comment $comment)
    {

        if (auth()->user()->hasRole('superAdmin')) {
            $comment->delete();
            return redirect()->back()->with('message', 'Comment deleted successfully');
        }
        return abort(403, 'Unauthorized action');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function restore(Comment $comment)
    {
        if (auth()->user()->hasRole('superAdmin')) {
            $comment->update([
                'is_approve' => true
            ]);
            return redirect()->back()->with('message', 'Comment restored successfully');
        }
        return abort(403, 'Unauthorized action');
    }
}
