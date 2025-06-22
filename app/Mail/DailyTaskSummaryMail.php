<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DailyTaskSummaryMail extends Mailable
{
    use Queueable, SerializesModels;
    public $tasks;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Daily Task Assignment Summary')
                    ->view('emails.daily_summary')
                    ->with(['tasks' => $this->tasks]);
    }
}
