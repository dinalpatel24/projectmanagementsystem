@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">{{ isset($editTask) ? 'Edit Task' : 'Create Task' }}</h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ isset($editTask) ? 'Edit Task' : 'Create Task' }}</h3>

        <form method="POST" action="{{ isset($editTask) ? route('tasks.update', $editTask->id) : route('tasks.store') }}">
            @csrf
            @if(isset($editTask)) @method('PUT') @endif

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" required
                       value="{{ old('title', $editTask->title ?? '') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $editTask->description ?? '') }}</textarea>
                @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="project_id" class="block text-sm font-medium text-gray-700">Project</label>
                <select name="project_id" id="project_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}"
                            {{ old('project_id', $editTask->project_id ?? '') == $project->id ? 'selected' : '' }}>
                            {{ $project->title }}
                        </option>
                    @endforeach
                </select>
                @error('project_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Assign To</label>
                <select name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">-- Select Team Member --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ old('user_id', $editTask->user_id ?? '') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-200 rounded text-sm text-gray-700 hover:bg-gray-300">Back</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-sm rounded hover:bg-indigo-700">
                    {{ isset($editTask) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
