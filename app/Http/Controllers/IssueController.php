<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\System;
use App\Models\IssueType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    /**
     * Show the form for creating a new issue.
     */
    public function create()
    {
        return Inertia::render('Report', [
            'systems' => System::all(),
            'issueTypes' => Issue::all()
        ]);
    }

    /**
     * Store a newly created issue in the database.
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

        Issue::create([
            'name' => $request->issue_name,
            'description' => $request->issue_description,
            'system_id' => $request->system,
            'user_id' => Auth::id(),
            'priority_id' => 1, // Default priority, adjust as needed
            'issue_type_id' => $request->issue_type,
            'status_id' => 1, // Default status, adjust as needed
            'supporting_documents' => $filePath,
        ]);

        return redirect()->route('issues.create')->with('success', 'Issue reported successfully!');
    }
}
