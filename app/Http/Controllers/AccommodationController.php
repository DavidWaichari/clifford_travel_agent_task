<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use Illuminate\Support\Facades\Validator;


class AccommodationController extends Controller
{
    public function index()
    {
        // Retrieve all accommodations
        $accommodations = Accommodation::all();

        return response()->json(['data' => $accommodations]);
    }

    public function show($id)
    {
        // Retrieve a specific accommodation by ID
        $accommodation = Accommodation::find($id);

        if (!$accommodation) {
            return response()->json(['error' => 'Accommodation not found'], 404);
        }

        return response()->json(['data' => $accommodation]);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'standard_rack_rate' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new accommodation
        $accommodation = Accommodation::create($request->all());

        return response()->json(['data' => $accommodation], 201);
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'description' => 'string',
            'standard_rack_rate' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Update an existing accommodation
        $accommodation = Accommodation::find($id);

        if (!$accommodation) {
            return response()->json(['error' => 'Accommodation not found'], 404);
        }

        $accommodation->update($request->all());

        return response()->json(['data' => $accommodation]);
    }

    public function destroy($id)
    {
        // Delete an accommodation by ID
        $accommodation = Accommodation::find($id);

        if (!$accommodation) {
            return response()->json(['error' => 'Accommodation not found'], 404);
        }

        $accommodation->delete();

        return response()->json(['message' => 'Accommodation deleted successfully']);
    }
}
