<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class TodosController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->getAuthIdentifier();
        $todos = \App\Models\Todos::where('user_id', $userId)->get();

        return Inertia::render('Todos/Index', [
            'todos' => $todos,
        ]);
    }

    public function storeTodo(Request $request)
    {
        $userId = auth()->user()->getAuthIdentifier();
        $todo = new \App\Models\Todos();
        $todo->title = request()->title;
        $todo->user_id = $userId;
        $todo->save();

        return redirect()->back();
    }

    public function updateTodo(Request $request)
    {
        $todo = \App\Models\Todos::find(request()->id);
        $todo->completed = request()->completed;
        $todo->save();

        return redirect()->back();
    }

    public function deleteTodo()
    {
        $todo = \App\Models\Todos::find(request()->id);
        $todo->delete();

        return redirect()->back();
    }
}
