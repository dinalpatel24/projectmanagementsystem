<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskAssignmentServiceInterface;
use App\Models\ActivityLog;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $tasks = Task::with('project', 'assignee')->get();
        return view('admin.tasks.index', compact('project', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        $projects = Project::all();
        $users = User::where('is_admin',0)->get();
        return view('admin.tasks.form', compact(['projects', 'users', 'editTask' => null ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->user_id = $request->user_id;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
        // return view('admin.tasks.edit', compact('project', 'task'));
        $projects = Project::all();
        $users = User::where('is_admin',0)->get();
        return view('admin.tasks.form', [
            'editTask' => $task,
            'projects' => $projects,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
    {
         $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'project_id' => $request->project_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    /**
     * Show assignment form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign(Task $task)
    {
        $users = User::where('is_admin',0)->get();
        return view('admin.tasks.assign', compact('task', 'users'));
    }

     /**
     * Handle assignment submission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeAssignment(Request $request, Task $task, TaskAssignmentServiceInterface $service)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $service->assign($task, $user);

        return redirect()->route('tasks.index')->with('success', 'Task assigned and email sent.');
    }

    public function showActivityLog()
    {
        $logs = ActivityLog::with(['task', 'assignedBy', 'assignedTo'])->latest()->get();
        return view('admin.activitylog.index', compact('logs'));
    }
}
