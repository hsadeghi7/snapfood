<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;
use App\Models\Profile;
use Illuminate\Http\Request;

class HasProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role === 'seller') {
            if (!Profile::where('user_id', auth()->id())->get()->first()) {
                return response()->view('seller.profiles.create', [
                    'restaurantCategories' => Category::where('type', 'restaurant')->get(),
                ]);
            }
        }
        return $next($request);
    }
}
