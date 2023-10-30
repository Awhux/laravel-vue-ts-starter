<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (!auth()->user()) {
      $tasks = Task::all();
    } else $tasks = Task::where('belongs_to', auth()->user()->id ?? null)->get()->sortByDesc('created_at')->values();

    return Inertia::render('Tasks/Index', [
      'tasks' => $tasks,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $task_validation = request()->validate([
      'title' => ['required', 'max:255'],
      'description' => ['required', 'max:255'],
    ]);

    $task = new Task();
    $task->title = $task_validation['title'];
    $task->description = $task_validation['description'];
    $task->belongs_to = auth()->user()->id;

    $task->save();

    return redirect()->back();
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
  public function update(UpdateTaskRequest $request, Task $task)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Task $task)
  {
    $task->delete();

    return redirect()->route('tasks');
  }
}
