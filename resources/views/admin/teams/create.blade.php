@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">
        {{ isset($team) ? 'Edit Team' : 'Create Team' }}
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900">
            {{ isset($team) ? 'Edit Team' : 'Create Team' }}
        </h3>

        <form method="POST" action="{{ isset($team) ? route('teams.update', $team) : route('teams.store') }}">
            @csrf
            @if(isset($team))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Team Name</label>
                <input type="text" name="name" id="name" required
                       value="{{ old('name', $team->name ?? '') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('name')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('teams.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                   Back
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700">
                    {{ isset($team) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
