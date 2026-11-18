<?php
namespace App\Http\Controllers;
use App\Mail\TaskCompletedMail;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::query()->where('is_archived', false)->orderBy('task_date')->orderBy('title')->get();
        return view('tasks.index', compact('tasks'));
    }
    public function create(): View { return view('tasks.create'); }
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:pending,in progress,done'],
            'task_date' => ['required', 'date'],
        ]);
        $data['is_archived'] = false;
        Task::query()->create($data);
        return redirect()->route('tasks.index')->with('status', 'Task created.');
    }
    public function edit(Task $task): View
    {
        abort_if($task->is_archived, 404);
        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, Task $task): RedirectResponse
    {
        abort_if($task->is_archived, 404);
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:pending,in progress,done'],
            'task_date' => ['required', 'date'],
        ]);
        $wasDone = $task->status === 'done';
        $task->update($data);
        if (! $wasDone && $task->status === 'done') {
            $recipient = config('services.task_notifications.recipient');
            if ($recipient) {
                Mail::to($recipient)->send(new TaskCompletedMail($task));
            }
        }
        return redirect()->route('tasks.index')->with('status', 'Task updated.');
    }
    public function destroy(Task $task): RedirectResponse
    {
        $task->update(['is_archived' => true]);
        return redirect()->route('tasks.index')->with('status', 'Task archived.');
    }
}
