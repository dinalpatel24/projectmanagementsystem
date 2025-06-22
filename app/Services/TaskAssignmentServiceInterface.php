<?php
namespace App\Services;

use App\Models\Task;
use App\Models\User;

interface TaskAssignmentServiceInterface
{
    public function assign(Task $task, User $user);
}
