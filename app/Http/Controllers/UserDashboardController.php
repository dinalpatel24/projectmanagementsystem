<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Team;
use App\Models\Project;

class UserDashboardController extends Controller
{
    public function index()
    {
        $teams = Auth::user()->teams; // Assuming user belongsToMany teams
        return view('user.teamList', compact('teams'));
    }

    public function listProject(Team $team) 
    {
        $projects = $team->projects()->with('team')->get(); // eager loading
        return view('user.projectlist', compact('team', 'projects'));
    }

    public function listTask(Project $project) 
    {
        $tasks = $project->tasks()->with('assignee')->get();
        return view('user.tasklist', compact('project', 'tasks'));
    }

    
}
