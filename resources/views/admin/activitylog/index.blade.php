@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">Activity Logs</h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Assigned To</th>
                    <th>Assigned By</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $i => $log)
                    <tr class="border-t">
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $log->task->title }}</td>
                        <td>{{ $log->assignedTo->name }}</td>
                        <td>{{ $log->assignedBy->name }}</td>
                        <td>{{ $log->message }}</td>
                        <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
