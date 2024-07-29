<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $divisions = Division::all();
        return Inertia::render("Divisions/Index",[
            'divisions' => $divisions,
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
    public function update(Request $request, Division $division)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean|nullable',
        ]);

        // Update the task with the validated data
        $division->update($validated);

        // Optionally add a flash message for feedback
        return redirect(route('divisions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        $division->delete();
        return redirect(route('divisions.index'));
    }
}
