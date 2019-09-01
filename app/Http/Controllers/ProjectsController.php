<?php

namespace App\Http\Controllers;

use App\Events\ProjectCreated;
use App\Project;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $projects = Project::where('owner_id', auth()->id())->get();

        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        // $project = new Project();
        // $project->title = request('title');
        // $project->description = request('description');
        // $project->save();

        
        // Project::create([
        //     'title' => request('title'),
        //     'description' => request('description')
        // ]);

        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);

        $attributes['owner_id'] = auth()->id();
        
        $project = Project::create($attributes);
        
        event(new ProjectCreated($project));

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        // $project = Project::findOrFail($id);
        // abort_if($project->owner_id !== auth()->id(), 403);
        // abort_if(\Gate::denies('update', $project), 403);

        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }
    
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);

        $project->update($attributes);

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/projects');
    }
}
