<?php

namespace App\Http\Controllers;
use App\Models\Issue_type;
use App\Models\Issue;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;
use App\Models\System;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $issues =  Issue_type::all();
       return response()->json($issues);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'system' => 'required|integer|exists:systems,id',
            'issue_type' => 'required|integer|exists:issue_types,id',
            'supporting_documents' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $issue = new Issue();
        $issue->name = $request->name;
        $issue->description = $request->description;
        $issue->system_id = $request->system;
        $issue->issue_type_id = $request->issue_type;
        $issue->user_id = Auth::id();  // Set the user_id to the ID of the authenticated user

        if ($request->hasFile('supporting_documents')) {
            $file = $request->file('supporting_documents');
            $path = $file->store('supporting_documents', 'public');
            $issue->supporting_documents = $path;
        }

        $issue->save();

        return redirect()->route('issues.index')->with('success', 'Issue reported successfully');
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
