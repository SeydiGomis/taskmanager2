@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la tâche</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Titre</label>
            <input type="text" id="name" name="name" value="{{ $task->name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4" required>{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="priority">Priority:</label>
            <select id="priority" name="priority"  class="form-control" required>
                <option value="High">High </option>
                <option value="Medium">Medium </option>
                <option value="Low">Low </option>
            </select>
        </div>
        <div class="form-group">
    <label for="due_date">Date d'échéance</label>
    <input type="date" id="due_date" name="due_date" class="form-control" value="{{ old('due_date', $task->due_date) }}">
</div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
