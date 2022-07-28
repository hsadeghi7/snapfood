<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Banner;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $banner = Banner::where('is_active', true)->first();
        $users = User::withTrashed()->with('roles')->where('id','<>', '1')->paginate(4);
        return view('dashboard', compact('users', 'banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:' . implode(',', Role::pluck('name')->toArray()),
        ]);

        $user->syncRoles($request->role);

        return redirect('/')->with('message', 'User role updated successfully');
    }

   public function activityToggle(Request $request)
    {

        $user = User::withTrashed()->find($request->id);

        if (!$user->deleted_at) {
            $user->delete();
        } else {
            $user->restore();
        }
        return back();
    }
}
