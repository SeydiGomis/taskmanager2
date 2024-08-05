<!-- resources/views/tasks/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Task List</h1>
    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('tasks.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search tasks" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <a href="{{ route('tasks.create') }}" class="btn btn-success">Create Task</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Priority</th>
                <th>Actions</th>
                <th>Due date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td> {{ $task->priority}}</td>
                <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Aucune' }}</td>

                <td class="d-flex">
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-info mr-2">View</a>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning mr-2">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tasks->links() }} 
</div>
@endsection
