<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return all issue types
        $issues = Issue::all();
        return response()->json($issues);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'system' => 'required|integer|exists:systems,id',
            'issue_type' => 'required|integer|exists:issue_types,id',
            'supporting_documents' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new issue
        $issue = new Issue();
        $issue->name = $request->name;
        $issue->description = $request->description;
        $issue->system_id = $request->system;
        $issue->issue_type_id = $request->issue_type;
        $issue->user_id = Auth::id(); // Set the user_id to the ID of the authenticated user

        // Handle supporting documents
        if ($request->hasFile('supporting_documents')) {
            $file = $request->file('supporting_documents');
            $path = $file->store('supporting_documents', 'public');
            $issue->supporting_documents = $path;
        }

        // Save the issue
        $issue->save();

        // Return success response
        return response()->json(['message' => 'Issue reported successfully'], 200);
    }

    /**
     * Get all priorities.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPriorities()
    {
        $priorities = Priority::all();
        return response()->json($priorities);
    }

    /**
     * Update the priority of the specified issue in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function setPriority(Request $request, Issue $issue)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'priorityId' => 'required|integer|exists:priorities,id',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Update the priority of the issue
        $issue->priority_id = $request->input('priorityId');
        $issue->save();

        // Return success response
        return response()->json(['message' => 'Priority updated successfully'], 200);
    }
}
