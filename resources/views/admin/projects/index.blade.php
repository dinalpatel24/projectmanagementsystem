@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">Projects</h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">All Projects</h3>
            <a href="{{ route('projects.create') }}" class="bg-indigo-600 px-4 py-2 rounded hover:bg-indigo-700">+ Create Project</a>
        </div>

        @if(session('success'))
            <div class="text-green-600 bg-green-100 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Team</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($projects as $index => $project)
                    <tr>
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $project->title }}</td>
                        <td class="px-6 py-4">{{ $project->team->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('projects.edit', $project) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
