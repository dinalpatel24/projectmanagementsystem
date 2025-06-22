<h1>Hello {{ $user->name }},</h1>

<p>You have been assigned a new task.</p>

<p><strong>Title:</strong> {{ $task->title }}</p>
<p><strong>Description:</strong> {{ $task->description }}</p>
<p><strong>Project:</strong> {{ $task->project->title ?? 'N/A' }}</p>

<p>Please log in to the system to view more details.</p>

<p>Thank you,<br>Your Admin Team</p>
