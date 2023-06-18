@extends('layouts.admin')

@section('content')
<div class="container p-5">
    <h1 class="fs-4 my-4">
        {{$project->name}}
    </h1>

    <div>
        <h3 class="py-4">Type -> {{$project->type}}</h3>
        <h4 class="py-2">Technologies used -> {{$project->technologies_used}}</h4>
        <h6 class="d-inline py-4">Description: </h6>
        <div class="text-white">
            <p>{!! $project->description !!}</p>
        </div>
        <span class="text-white">Numbers of Collaborators: {{$project->number_of_collaborators}} |</span>
        <span class="text-white">Project start date: {{$project->dateOfStart_formatted}} |</span>
        <span class="text-white">Project end date: {{$project->dateOfFinish_formatted}} |</span>
    </div>


</div>
@endsection
