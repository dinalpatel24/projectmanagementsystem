@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">Tasks for {{ $project->title }}</h2>
@endsection

@section('content')

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">Task List</h3>
        </div>

        @if(session('success'))
            <div class="text-green-600 bg-green-100 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Assignee</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($tasks as $i => $task)
                    <tr>
                        <td class="px-6 py-4">{{ $i + 1 }}</td>
                        <td class="px-6 py-4">{{ $task->title }}</td>
                        <td class="px-6 py-4">{{ $task->assignee->name ?? 'Unassigned' }}</td>
                        <td class="px-6 py-4">{{ $task->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
