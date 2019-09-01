<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // protected $fillable = ['title', 'description'];
    protected $guarded = [];

    // protected $dispatchesEvents = [
    //     'created' => ProjectCreated::class
    // ];

    protected static function boot()
    {
        parent::boot();

        // static::created(function ($project) {
        //     Mail::to($project->owner->email)->send(
        //         new ProjectCreated($project)
        //     );
        // });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        $this->tasks()->create($task);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
