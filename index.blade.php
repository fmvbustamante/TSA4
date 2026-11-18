@extends('layouts.app')
@section('title','Task List')
@section('content')
<header class="page-head"><div><h1 class="page-title">All tasks</h1><p class="page-intro">Your active tasks, ordered by scheduled date.</p></div>@auth<a class="button button-primary" href="{{ route('tasks.create') }}">+ Add task</a>@endauth</header>
@if(session('status'))<div class="flash-success" role="status">{{ session('status') }}</div>@endif
@if($tasks->isEmpty())<section class="empty-state"><h3>No active tasks</h3><p>@auth Add a task to get started.@else Log in to create a task.@endauth</p></section>@else
@foreach($tasks->groupBy(fn($task)=>$task->task_date->toDateString()) as $date=>$dateTasks)<section class="date-group"><h2 class="date-heading">{{ \Illuminate\Support\Carbon::parse($date)->format('l, F j, Y') }}</h2><div class="task-list">@foreach($dateTasks as $task)<article class="task-card"><span class="task-check {{ $task->status==='done'?'is-complete':'' }}">{{ $task->status==='done'?'✓':'' }}</span><div class="task-copy"><h3>{{ $task->title }}</h3><span class="task-date">{{ $task->task_date->format('M j, Y') }}</span></div><span class="status-badge status-{{ str_replace(' ','-',$task->status) }}">{{ ucfirst($task->status) }}</span>@auth<a class="table-action" href="{{ route('tasks.edit',$task) }}">Edit</a><form method="POST" action="{{ route('tasks.destroy',$task) }}" onsubmit="return confirm('Archive this task?')">@csrf @method('DELETE')<button class="link-button" type="submit">Archive</button></form>@endauth</article>@endforeach</div></section>@endforeach
@endif
@endsection
