@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">{{ $project->exists ? 'Edit' : 'Create' }} Project</h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900">
            {{ isset($team) ? 'Edit Project' : 'Create Project' }}
        </h3>
        <form method="POST" action="{{ $project->exists ? route('projects.update', $project) : route('projects.store') }}">
            @csrf
            @if($project->exists)
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('title')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="team_id" class="block text-sm font-medium text-gray-700">Team</label>
                <select name="team_id" id="team_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">-- Select Team --</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ old('team_id', $project->team_id) == $team->id ? 'selected' : '' }}>
                            {{ $team->name }}
                        </option>
                    @endforeach
                </select>
                @error('team_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('projects.index') }}" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Back</a>
                <button type="submit" class="bg-indigo-600 px-4 py-2 rounded hover:bg-indigo-700">
                    {{ $project->exists ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
