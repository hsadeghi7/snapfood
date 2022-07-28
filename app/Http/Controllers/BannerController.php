<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Banner::class, 'banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.banners.index', [
            'banners' => Banner::paginate(3),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $validated = $request->validated();
        $imagePath = Storage::disk('public')->put('images/banners/', $validated['image']);

        Banner::create(
            [
                'image' => $imagePath,
                'is_active' => false
            ]
        );
        return redirect('/admin/banners')->with('message', 'Banner created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBannerRequest  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        Banner::all()->each(function ($banner) {
            $banner->is_active = false;
            $banner->save();
        });

        $banner->update([
            'is_active' => true,
        ]);
        return redirect('/admin/banners')->with('message', 'Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect('/admin/banners')->with('message', 'Banner deleted successfully');
    }
}
