<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\System;
use Illuminate\Support\Facades\Auth;

class SystemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systems =  System::all();
       return response()->json($systems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'issue_name' => 'required|string|max:255',
            'issue_description' => 'required|string',
            'system' => 'required|exists:systems,id',
            'issue_type' => 'required|exists:issue_types,id',
            'supporting_doc' => 'nullable|file|max:10240', // max 10MB
        ]);

        $filePath = null;
        if ($request->hasFile('supporting_doc')) {
            $filePath = $request->file('supporting_doc')->store('supporting_docs', 'public');
        }

       $systems =  System::create([
            'name' => $request->issue_name,
            'description' => $request->issue_description,
            'system_id' => $request->system,
            'user_id' => Auth::id(),
            'priority_id' => 1, // Default priority, adjust as needed
            'issue_type_id' => $request->issue_type,
            'status_id' => 1, // Default status, adjust as needed
            'supporting_documents' => $filePath,
        ]);
        // return the created data 
        return response()->json($systems);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
