<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskAssignment;
use App\Models\Issue;
use Illuminate\Support\Facades\Validator;

class TaskAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'issue_id' => 'required|integer|exists:issues,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new task assignment
        $taskAssignment = new TaskAssignment();
        $taskAssignment->issue_id = $request->issue_id;
        $taskAssignment->user_id = $request->user_id;
        $taskAssignment->save();

        // Update the status_id of the assigned issue
        $issue = Issue::find($request->issue_id);
        $issue->status_id = 2;
        $issue->save();

        // Return success response
        return response()->json(['message' => 'Task assigned and issue status updated successfully'], 200);
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
