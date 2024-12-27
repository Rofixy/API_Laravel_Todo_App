<?php

// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Menampilkan semua tugas
    public function index()
    {
        $tasks = Task::all();

        return response()->json([
            'data' => $tasks,
        ]);
    }

    // Menyimpan tugas baru
    public function store(Request $request)
    {
        // Validasi berdasarkan field yang ada di JSON (task_name, description, due_date)
        $validated = $request->validate([
            'task' => 'required|string|max:255',  // Perhatikan bahwa field yang divalidasi adalah 'task_name'
            'description' => 'required|string|max:500',
            'due_date' => 'nullable|date',
        ]);
    
        // Membuat task baru berdasarkan data yang telah tervalidasi
        $task = Task::create($validated);
    
        // Mengembalikan response dengan task yang telah dibuat
        return response()->json($task, 201);
    }
    

    // Menampilkan form untuk mengedit tugas
    public function edit(Task $task)
    {
        // Mengembalikan data task dalam format JSON
        return response()->json([
            'data' => $task,
        ]);
    }
    

    // Mengupdate tugas
    public function update(Request $request, Task $task)
    {
        // Validasi input
        $validated = $request->validate([
            'task' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'due_date' => 'nullable|date',
        ]);
    
        // Update data task dengan input yang tervalidasi
        $task->update($validated);
    
        // Mengembalikan response JSON dengan status sukses
        return response()->json([
            'message' => 'Task updated successfully.',
            'data' => $task,
        ]);
    }
    

    // Menghapus tugas
    public function destroy(Task $task)
    {
        // Menghapus task
        $task->delete();
    
        // Mengembalikan response JSON dengan pesan sukses
        return response()->json([
            'message' => 'Task deleted successfully.',
        ], 200);
    }
    
}
