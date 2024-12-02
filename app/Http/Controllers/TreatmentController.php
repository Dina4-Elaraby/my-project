<?php

namespace App\Http\Controllers;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        return response()->json(Treatment::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $treatment = Treatment::create($validatedData);

        return response()->json($treatment, 201); // إرجاع السجل الذي تم إنشاؤه مع كود حالة HTTP 201
    }

    public function destroy($id)
{
    // Find the treatment by ID
    $treatment = Treatment::find($id);

    // Check if the treatment exists
    if (!$treatment) {
        return response()->json(['message' => 'Treatment not found'], 404);
    }

    // Delete the treatment
    $treatment->delete();

    // Return a success response
    return response()->json(['message' => 'Treatment deleted successfully'], 200);
}

}
