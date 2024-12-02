<?php

namespace App\Http\Controllers;
use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    //
    public function index()
{
    // $diseases = Disease::all();
    // return response()->json($diseases);
    

    $diseases = Disease::all()->map(function ($disease) {

        $disease->symptoms = is_string($disease->symptoms) ? json_decode($disease->symptoms) : $disease->symptoms;

        $disease->factors = is_string($disease->factors) ? json_decode($disease->factors) : $disease->factors;

        $disease->affected_plants = is_string($disease->affected_plants) ? json_decode($disease->affected_plants) : $disease->affected_plants;

        return $disease;

    });



    return response()->json($diseases);


}

public function store(Request $request)
{

    
    $request->validate([
        'name' => 'required|string|max:255',
        'symptoms' => 'nullable|array',
        'factors' => 'nullable|array',
        'treatment' => 'nullable|string',
        'affected_plants' => 'nullable|array',
    ]);

    $validatedData['symptoms'] = json_encode($validatedData['symptoms'] ?? []);
    $validatedData['factors'] = json_encode($validatedData['factors'] ?? []);
    $validatedData['affected_plants'] = json_encode($validatedData['affected_plants'] ?? []);

     Disease::create($request->all());

    return response()->json(['message' => 'Disease created successfully'], 201);
    
}
public function destroy(string $id)
    {
        // البحث عن المرض باستخدام المعرف
        $disease = Disease::find($id);

        // إذا لم يتم العثور على المرض
        if (!$disease) {
            return response()->json(['message' => 'Disease not found'], 404);
        }

        // حذف المرض
        $disease->delete();

        // إرجاع رسالة نجاح
        return response()->json(['message' => 'Disease deleted successfully'], 200);
    }

}