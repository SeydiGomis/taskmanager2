<!-- resources/views/tasks/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une nouvelle tâche</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label for="priority">Priority:</label>
            <select id="priority" name="priority" class="form-control">
                <option value="High" {{ old('priority') === 'High' ? 'selected' : '' }}>High</option>
                <option value="Medium" {{ old('priority') === 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Low" {{ old('priority') === 'Low' ? 'selected' : '' }}>Low</option>
            </select>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date:</label>
            <input type="date" id="due_date" name="due_date" class="form-control" value="{{ old('due_date') }}">
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
