<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileRequest $request)
    {
        Profile::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'account_number' => $request->account_number,
            'type' => $request->type,
        ]);
        return back()->with('massage', 'Profile create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $restaurantCategories =  Category::where('type', 'restaurant')->get();
        return view('seller.profiles.edit', compact('profile','restaurantCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        // dd($request->all());
        $profile->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'account_number' => $request->account_number,
            'type' => $request->type,
        ]);
        return redirect('/')->with('message', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
