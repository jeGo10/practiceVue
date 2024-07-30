<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // Eager load the 'roles' relationship using a query builder
        $user = User::with('roles')->find(Auth::id());

        $user_id = auth()->user()->id;
        $tasks = Task::where("user_id", $user_id)->with("user:id,name")->get();
        return Inertia::render('Tasks/Index',[
            'tasks' => $tasks,
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
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string|max:255'
        ]);
        $request->user()->tasks()->create($validated);
        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task){
    // Validate the request data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'progress' => 'boolean|nullable',
    ]);

    // Update the task with the validated data
    $task->update($validated);

    // Optionally add a flash message for feedback
    return redirect(route('tasks.index'))->with('status', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(route('tasks.index'));
    }
}
