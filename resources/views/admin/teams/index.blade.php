@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">Teams</h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Team List</h3>
            <a href="{{ route('teams.create') }}" class="px-4 py-2 bg-indigo-600 text-sm font-semibold rounded hover:bg-indigo-700">
                + Create Team
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 text-sm text-green-600 bg-green-100 p-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($teams as $team)
                        <tr>
                            <td class="px-6 py-4">{{ $team->id }}</td>
                            <td class="px-6 py-4">{{ $team->name }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('teams.edit', $team) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('teams.destroy', $team) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
