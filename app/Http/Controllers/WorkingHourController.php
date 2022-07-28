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
