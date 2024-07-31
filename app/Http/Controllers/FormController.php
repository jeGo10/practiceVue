<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // Eager load the 'roles' relationship using a query builder
        $user = User::with('roles')->find(Auth::id());
        $forms = Form::all();
        return Inertia::render('Forms/Index', [
            'forms' => $forms,
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
        $validatedData = $request->validate([
            'doc_ref_code' => 'required|string|max:255',
            'doc_title' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'process_owner' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'doc_type' => 'required|string|max:255',
            'request_type' => 'required|string|max:255',
            'request_reason' => 'required|string|max:255',
            'requester' => 'required|string|max:255',
            'request_date' => 'required|date',
            'revision_num' => 'required|string|max:255',
            'effectivity_date' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docx'
        ]);

        $form = new Form($validatedData);
        $form->user_id = Auth::id();
        $form->save();

        return redirect()->route('forms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form): Response
    {
        return Inertia::render('Forms/Show', [
            'form' => $form
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        $validatedData = $request->validate([
            'doc_ref_code' => 'required|string|max:255',
            'doc_title' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'process_owner' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'doc_type' => 'required|string|max:255',
            'request_type' => 'required|string|max:255',
            'request_reason' => 'required|string|max:255',
            'requester' => 'required|string|max:255',
            'request_date' => 'required|date',
            'revision_num' => 'required|string|max:255',
            'effectivity_date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx'
        ]);

        $form->update($validatedData);

        return redirect()->route('forms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();

        return redirect()->route('forms.index');
    }
}
