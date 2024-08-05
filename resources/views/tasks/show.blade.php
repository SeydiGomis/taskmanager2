<!-- resources/views/tasks/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ $task->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Priority:</strong> {{ $task->priority }}</p>
            <p><strong>Due Date:</strong> {{ $task->due_date ? $task->due_date->format('d/m/Y') : 'None' }}</p>
            <div class="d-flex justify-content-between">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
