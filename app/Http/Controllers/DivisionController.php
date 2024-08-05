<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;
use App\Models\HistoryLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // Eager load the 'roles' relationship using a query builder
        $user = User::with('roles')->find(Auth::id());


        $divisions = Division::all();
        $historyLogs = HistoryLog::latest()->get();
        return Inertia::render("Divisions/Index",[
            'divisions' => $divisions,
            'historyLogs' => $historyLogs,
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
    public function store(Request $request) : RedirectResponse
    {
    // Validate the incoming request data
    $validated = $request->validate([
        'name' => 'required|string',
        'status' => 'required|string',
    ]);

    // Create a new Division record using the validated data
    Division::create([
        'name' => $validated['name'],
        'status' => $validated['status'],
    ]);

    $user = Auth::user();

    // Log the action
    HistoryLog::create([
        'user_id' => $user->id,
        'action' => $user->name . ' has added a new division ' . $validated['name'],
    ]);

    // Redirect to the index route with a success message
    return redirect(route('divisions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division) :RedirectResponse
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean|nullable',
        ]);

        // Update the task with the validated data
        $division->update($validated);

        $user = Auth::user();

        HistoryLog::create([
            'user_id' => $user->id,
            'action' => $user->name . ' has updated the division ' . $division->name,
        ]);

        // Optionally add a flash message for feedback
        return redirect(route('divisions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division) :RedirectResponse
    {
        $division->delete();
        $user = Auth::user();

        HistoryLog::create([
            'user_id' => $user->id,
            'action' => $user->name . ' has deleted the division ' . $division->name,
        ]);

        return redirect(route('divisions.index'));
    }
}
