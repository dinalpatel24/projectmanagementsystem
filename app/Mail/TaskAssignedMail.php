<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;


class TaskAssignedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $task;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('New Task Assigned')
                    ->view('emails.task_assigned')->with([
                    'task' => $this->task,
                    'user' => $this->task->assignee, // user relation
                ]);

    }
}
