<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;


class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return Treatment::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $treatment = Treatment::create ($request->all());
        return response()->json($treatment,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $treatment = Treatment::find ($id);
        if(!$treatment)
        {
            return response()->json(['message'=>"Treatment not found "],404);
        }
        return $treatment;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $treatment = Treatment::find ($id);
        if(!$treatment)
        {
            return response()->json(['message'=>"Treatment not found "],404);
        }
        $treatment ->update($request->all());
        return response()->json($treatment,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $treatment = Treatment::find ($id);
        if(!$treatment)
        {
            return response()->json(['message'=>"Treatment not found "],404);
        }
        $treatment ->delete();
        return response()->json(['message'=>'The Treatment is deleted'],200);
    }
}
