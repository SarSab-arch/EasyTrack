<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('category')->orderBy('created_at', 'desc')->get();
    
        return view('admin.tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::with('category')->findOrFail($id);

        return view('admin.tasks.show', compact('task'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $task = Task::findOrFail($id);
        
        $task->status = $request->status;
        $task->save();

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح!');
    }
    public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->delete();

    return redirect()->back()->with('success', 'تم حذف الطلب بنجاح!');
}
}