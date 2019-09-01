@extends('layout')

@section('content')
    <h1 class="title">Edit Project</h1>

    <form method="POST" action="/projects/{{ $project->id }}" style="margin-bottom: 1em;">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="field">
            <label for="title" class="label">Title</label>
            <div class="control">
                <input type="text" name="title" class="input" placeholder="Title" value="{{ $project->title }}" required>
            </div>
        </div>

        <div class="field">
            <label for="description" class="label">Description</label>
            <div class="control">
                <textarea name="description" class="textarea" required>{{ $project->description }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Project</button>
            </div>
        </div>
    </form>

    @include('errors')

    <form method="POST" action="/projects/{{ $project->id }}">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-danger">Delete Project</button>
            </div>
        </div>
    </form>
@endsection