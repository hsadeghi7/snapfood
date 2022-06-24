<?php

namespace App\Http\Controllers;

use App\Models\workingHour;
use App\Http\Requests\StoreworkingHourRequest;
use App\Http\Requests\UpdateworkingHourRequest;

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
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\workingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function show(workingHour $workingHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\workingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function edit(workingHour $workingHour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateworkingHourRequest  $request
     * @param  \App\Models\workingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateworkingHourRequest $request, workingHour $workingHour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\workingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(workingHour $workingHour)
    {
        //
    }
}
