<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load the 'roles' relationship using a query builder
        $user = User::with('roles')->find(Auth::id());
        $divisions = Division::where('status', '1')->get();

        $projects = Project::all();
        return Inertia::render("Projects/Index",[
            'projects' => $projects,
            'divisions' => $divisions,
            'auth' => [
                'user' => $user
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id', // Ensure division_id exists in the divisions table
            'title' => 'required|string',
            'status' => 'required|string',
        ]);

        // Create a new Project record using the validated data
        Project::create([
            'division_id' => $validated['division_id'],
            'title' => $validated['title'], // Correct the key from 'name' to 'title'
            'status' => $validated['status'],
        ]);

        // Redirect to the index route with a success message
        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Validate the request data
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'title' => 'required|string|max:255',
            'status' => 'boolean|nullable',
        ]);

        // Update the task with the validated data
        $project->update($validated);

        // Optionally add a flash message for feedback
        return redirect(route('projects.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect(route('projects.index'));
    }
}
