<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\Division;
use App\Models\Project;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $divisions = Division::where('status', '1')->get();
        $project = Project ::all();

        return Inertia::render('Forms/Index', [
            'forms' => $forms,
            'divisions' => $divisions,
            'projects' => $project,
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
    $validatedData = $request->validate([
        'doc_ref_code' => 'required|string|max:255',
        'doc_title' => 'required|string|max:255',
        'division' => 'required|string|max:255',
        'project' => 'required|string|max:255',
        'owner' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'doc_type' => 'required|string|max:255',
        'request_type' => 'required|string|max:255',
        'request_reason' => 'required|string|max:255',
        'request_date' => 'required|date',
        'revision_num' => 'required|integer',
        'effectivity_date' => 'required|date',
        'file' => 'required|file|mimes:pdf,doc,docx',
        'type' => 'required|string|max:255'
    ]);

    // Handle file upload
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('documents', 'public');
        $validatedData['file'] = $filePath; // assuming there's a file_path column in your table
    }

    // Create a new form entry
    $form = new Form($validatedData);
    $form->user_id = Auth::id();
    $form->save();

    // Redirect to the forms index route
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
            'doc_title' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'doc_type' => 'required|string|max:255',
            'revision_num' => 'required|integer',
            'effectivity_date' => 'required|date',
        ]);

        $form->update($validatedData);

        return redirect()->route('forms.index');
    }
    // Get the PDF file path
    public function getPDF(Form $form)
    {
        $filePath = storage_path('app/public/' . $form->file);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->file($filePath);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
         // Create an archive entry
         $archive = new Archive();
         $archive->doc_ref_code = $form->doc_ref_code;
         $archive->doc_title = $form->doc_title;
         $archive->division = $form->division;
         $archive->project = $form->project;
         $archive->owner = $form->owner;
         $archive->status = 'Inactive';
         $archive->doc_type = $form->doc_type;
         $archive->request_type = $form->request_type;
         $archive->request_reason = $form->request_reason;
         $archive->request_date = $form->request_date;
         $archive->revision_num = $form->revision_num;
         $archive->effectivity_date = $form->effectivity_date;
         $archive->file = $form->file;
         $archive->type = $form->type;
         $archive->archived_at = now();

         $archive->save();

         // Delete the form
         $form->delete();

        return redirect()->route('forms.index');
    }
}
