<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use Illuminate\Support\Facades\Validator;
use Auth;


class ContractController extends Controller
{
    public function index()
    {
        // Retrieve all contracts
        $contracts = Contract::all();

        return response()->json(['data' => $contracts]);
    }

    public function show($id)
    {
        // Retrieve a specific contract by ID
        $contract = Contract::find($id);

        if (!$contract) {
            return response()->json(['error' => 'contract not found'], 404);
        }

        return response()->json(['data' => $contract]);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'rate' => 'required|numeric',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'accommodation_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $request['travel_agent_id'] = Auth::user()->travel_agent->id;
        // Create a new contract
        $contract = Contract::create($request->all());

        return response()->json(['data' => $contract], 201);
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'rate' => 'required|numeric',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'accommodation_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Update an existing contract
        $contract = Contract::find($id);

        if (!$contract) {
            return response()->json(['error' => 'contract not found'], 404);
        }

        $contract->update($request->all());

        return response()->json(['data' => $contract]);
    }

    public function destroy($id)
    {
        // Delete an contract by ID
        $contract = Contract::find($id);

        if (!$contract) {
            return response()->json(['error' => 'contract not found'], 404);
        }

        $contract->delete();

        return response()->json(['message' => 'contract deleted successfully']);
    }
}
