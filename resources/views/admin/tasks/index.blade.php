@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">Task</h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white p-6 shadow rounded">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">All Tasks</h3>
            <a href="{{ route('tasks.create') }}" class="mb-4 bg-indigo-600 px-4 py-2 rounded">+ Create Task</a>
        </div>

        @if(session('success')) <div class="text-green-600">{{ session('success') }}</div> @endif

        <table class="w-full mt-4">
            <thead><tr><th>#</th><th>Title</th><th>Project Name</th><th>Assigned To</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($tasks as $i => $task)
                <tr class="border-t">
                    <td>{{ $i+1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->project->title }}</td>
                    <td>{{ $task->assignee ? $task->assignee->name : '-' }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-indigo-600">Edit</a> | 
                        <a href="{{ route('tasks.assign', $task->id) }}" class="ml-2 text-green-600">Assign</a> |
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600" onclick="return confirm('Sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
