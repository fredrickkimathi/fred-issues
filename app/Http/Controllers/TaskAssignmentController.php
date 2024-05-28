<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskAssignment;
use App\Models\Issue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\TaskAssigned; 
use Illuminate\Support\Facades\Validator;

class TaskAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // Fetch assigned issues with issue name, issue description, system name, and assigned user name
        $assignedIssues = TaskAssignment::with(['issue.system', 'user'])
        ->get()
        ->map(function ($taskAssignment) {
            return [
                'issue_name' => $taskAssignment->issue->name,
                'issue_description' => $taskAssignment->issue->description,
                'system_name' => $taskAssignment->issue->system->name,
                'assigned_user' => $taskAssignment->user->name,
            ];
        });

    return response()->json($assignedIssues);
    }

    public function getMyIssues($id){
        // Get the currently logged-in user
        $user = User::find($id);
        
        // Get the task assignments that belong to the currently logged-in user
        $myIssues = TaskAssignment::where('user_id', $user->id)->get();
        
        return response()->json($myIssues);
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

        // Send email to the assigned user
        $assignedUser = User::find($request->user_id);
        Mail::to($assignedUser->email)->send(new TaskAssigned($taskAssignment)); 

        // Return success response
        return response()->json(['message' => 'Task assigned and issue status updated successfully'], 200);
    }


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
