<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();

        return view('home', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|string|min:3|max:120',
                'description' => 'nullable|string',
                'status' => 'required|in:todo,doing,done',
                'due_date' => 'nullable|date|after_or_equal:today',
            ],
            [
                'title.required' => 'O título é obrigatório.',
                'due_date.after_or_equal' => 'A data de vencimento não pode ser no passado.',
            ]
        );

        auth()->user()->tasks()->create($validated);

        return redirect('/')->with('success', 'Tarefa criada com sucesso!');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate(
            [
                'title' => 'required|string|min:3|max:120',
                'description' => 'nullable|string',
                'status' => 'required|in:todo,doing,done',
                'due_date' => 'nullable|date|after_or_equal:today',
            ],
            [
                'title.required' => 'O título é obrigatório.',
                'due_date.after_or_equal' => 'A data de vencimento não pode ser no passado.',
            ]
        );

        $task->update($validated);

        return redirect('/')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect('/')->with('success', 'Tarefa excluída com sucesso!');
    }
}