<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        // Task::create([
        //     'project_id' => $project->id,
        //     'description' => request('description')
        // ]);

        $attributes = request()->validate(['description' => 'required']);
        $project->addTask($attributes);

        return back();
    }

    public function update(Task $task)
    {
        $task->complete(request()->has('completed'));

        return back();
    }
}
