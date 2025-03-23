<?php

namespace App\Http\Controllers;

use App\Models\Important;
use Illuminate\Http\Request;

class ImportantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Front.Pages.links");
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Important  $important
     * @return \Illuminate\Http\Response
     */
    public function show(Important $important)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Important  $important
     * @return \Illuminate\Http\Response
     */
    public function edit(Important $important)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Important  $important
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Important $important)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Important  $important
     * @return \Illuminate\Http\Response
     */
    public function destroy(Important $important)
    {
        //
    }
}
