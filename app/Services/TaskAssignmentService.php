<?php
namespace App\Services;

use App\Models\Task;
use App\Models\User;
use App\Mail\TaskAssignedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ActivityLog;
use App\Models\Teamuser;
use Auth;

class TaskAssignmentService implements TaskAssignmentServiceInterface
{
    public function assign(Task $task, User $user)
    {
        $task->user_id = $user->id;
        $task->save();

        ActivityLog::create([
            'task_id'     => $task->id,
            'assigned_by' => Auth::id(),
            'assigned_to' => $user->id,
            'message'     => "Task '{$task->title}' assigned to {$user->name}.",
        ]);

        Teamuser::firstOrCreate([
            'user_id' => $user->id,
            'team_id' => $task->project->team_id,
        ]);

        Mail::to($user->email)->queue(new TaskAssignedMail($task));
    }
}
