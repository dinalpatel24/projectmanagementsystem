<h2>📝 Task Assignment Summary ({{ \Carbon\Carbon::yesterday()->toFormattedDateString() }})</h2>

<table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th>#</th>
            <th>Task</th>
            <th>Project</th>
            <th>Assigned To</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $i => $task)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->project->title ?? '—' }}</td>
                <td>{{ $task->assignee->name ?? 'Unassigned' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
