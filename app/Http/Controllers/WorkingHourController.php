<?php

namespace App\Http\Controllers;

use App\Models\workingHour;
use App\Http\Requests\StoreworkingHourRequest;
use App\Http\Requests\UpdateworkingHourRequest;
use App\Models\Restaurant;
use App\Models\WorkingHour as ModelsWorkingHour;

class WorkingHourController extends Controller
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
    public function create(Restaurant $restaurant)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreworkingHourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreworkingHourRequest $request)
    {
        // dd($request->all());
        WorkingHour::create([
            'day' => $request->day,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'restaurant_id' => $request->restaurant_id,
        ]);

        return back()->with('message','Working Hour Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\workingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingHour $workingHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\workingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkingHour $workingHour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateworkingHourRequest  $request
     * @param  \App\Models\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateworkingHourRequest $request, WorkingHour $workingHour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingHour $workingHour)
    {
        // dd($workingHour);
        $workingHour->delete();
        return back()->with('message','Working Hour Deleted Successfully');
    }
}
