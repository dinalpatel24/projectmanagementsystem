<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'assigned_by', 'assigned_to', 'message'];

    public function assignedBy() {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    
    public function task() 
    { 
        return $this->belongsTo(Task::class); 
    }
}
