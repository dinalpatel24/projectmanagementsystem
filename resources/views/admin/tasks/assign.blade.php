@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">Assign Task</h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium mb-4">Assign Task: <span class="text-indigo-600">{{ $task->title }}</span></h3>

        <form method="POST" action="{{ route('tasks.storeAssignment', $task->id) }}">
            @csrf

            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Select User</label>
                <select name="user_id" id="user_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">-- Select Team Member --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('tasks.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">Cancel</a>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-sm rounded hover:bg-indigo-700">Assign</button>
            </div>
        </form>
    </div>
</div>
@endsection
