<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    // Show all plants, or search by common_name if provided
    public function index(Request $request)
    {
        $query = Plant::query(); // Initialize the query

        // Check if 'common_name' is provided and filter results
        if ($request->has('common_name')) {
            $query->where('common_name', 'like', '%' . $request->input('common_name') . '%');
        }

        // Get the results based on the query
        $plants = $query->get();

        // If no plants are found, return a message
        if ($plants->isEmpty()) {
            return response()->json([
                'message' => 'No plants found with the given common name.'
            ], 404); // 404 Not Found
        }

        // Return the results if plants are found
        return response()->json($plants, 200);
    }

    // Show a single plant
    public function show($id)
    {
        $plant = Plant::findOrFail($id);  // Find the plant by its ID
        return response()->json($plant);
    }

    // Create a new plant
    public function store(Request $request)
    {
        $validated = $request->validate([
            'scientific_name' => 'required|string|max:255',
            'common_name' => 'required|string|max:255',
            'plant_family' => 'required|string|max:255',
            'care_instructions' => 'required|string',
        ]);

        $plant = Plant::create($validated);  // Create a new plant with validated data
        return response()->json($plant, 201);  // Return the newly created plant
    }

    // Update an existing plant
    public function update(Request $request, $id)
    {
        $plant = Plant::findOrFail($id);  // Find the plant by ID

        // Validate the incoming request data
        $validated = $request->validate([
            'scientific_name' => 'required|string|max:255',
            'common_name' => 'required|string|max:255',
            'plant_family' => 'required|string|max:255',
            'care_instructions' => 'required|string',
        ]);

        $plant->update($validated);  // Update the plant with new data
        return response()->json($plant);  // Return the updated plant
    }

    // Delete a plant
    public function destroy($id)
    {
        $plant = Plant::findOrFail($id);  // Find the plant by ID
        $plant->delete();  // Delete the plant
        return response()->json(['message' => 'Plant deleted successfully']);
    }
}
