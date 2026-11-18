@extends('layouts.app')
@section('title','Welcome')
@section('content')
<section class="hero"><span class="eyebrow">Tasks for today · {{ now()->format('l, F j') }}</span><h1>Make today feel manageable.</h1><p>Your daily overview, with protected tools for managing tasks.</p>@auth<a class="button button-light" href="{{ route('tasks.create') }}">Create a task →</a>@else<a class="button button-light" href="{{ route('login') }}">Log in to manage tasks →</a>@endauth</section>
<div class="section-heading"><div><h2>Today’s tasks</h2><p>Only active tasks scheduled for today appear here.</p></div><span class="count-pill">{{ $tasks->count() }} tasks</span></div>
@if(session('status'))<div class="flash-success">{{ session('status') }}</div>@endif
@if($tasks->isEmpty())<section class="empty-state"><h3>You’re all caught up</h3><p>No active tasks are scheduled for today.</p></section>@else<div class="task-list">@foreach($tasks as $task)<article class="task-card"><span class="task-check {{ $task->status==='done'?'is-complete':'' }}">{{ $task->status==='done'?'✓':'' }}</span><div class="task-copy"><h3>{{ $task->title }}</h3><span class="task-date">{{ $task->task_date->format('M j, Y') }}</span></div><span class="status-badge status-{{ str_replace(' ','-',$task->status) }}">{{ ucfirst($task->status) }}</span></article>@endforeach</div>@endif
@endsection
