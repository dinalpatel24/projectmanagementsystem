<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\User;
use App\Mail\DailyTaskSummaryMail;
use App\Mail\TaskAssignedMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class taskSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:task-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $yesterday = Carbon::yesterday()->startOfDay();
        $today = Carbon::today()->startOfDay();

        $tasks = Task::with('assignee', 'project')
            ->whereBetween('updated_at', [$yesterday, $today])
            ->whereNotNull('user_id') // Only assigned tasks
            ->get();

        if ($tasks->isEmpty()) {
            $this->info('No tasks assigned yesterday.');
            return;
        }

        // You can update this to send to multiple admins
        $adminEmail = config('mail.admin_email', 'kash@admin.com');

        // Send email to admin (all assign email in one table)
        Mail::to($adminEmail)->queue(new DailyTaskSummaryMail($tasks));

        // Send email to users
        foreach ($tasks as $task) {
            if ($task->assignee && $task->assignee->email) {
                Mail::to($task->assignee->email)->queue(new TaskAssignedMail($task));
                $this->info("Mail queued to: " . $task->assignee->email);
            }
        }
        $this->info('Daily task summary email sent.');
    }
}
