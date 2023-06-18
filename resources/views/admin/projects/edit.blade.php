@extends('layouts.admin')

@section('content')
<div class="container p-5">
    <h1 class="fs-4 my-4">
        Edit New Project
    </h1>

    @if ($errors->any())

        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <form action="{{route('admin.projects.store', $project)}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label text-white">Name of Project</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name', $project->name)}}"
                placeholder="Name"
            >
        </div>

        <div class="mb-3">
            <label for="type" class="form-label text-white">Type of Project</label>
            <input
                type="text"
                class="form-control @error('type') is-invalid @enderror"
                id="type"
                name="type"
                value="{{ old('type', $project->type)}}"
                placeholder="Type"
            >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label text-white">Description of Project</label>
            <textarea
                class="form-control @error('description') is-invalid @enderror"
                placeholder="Description"
                name="description"
                id="description"
                cols="30"
                rows="10">{{ old('description', $project->description)}}</textarea>
        </div>

        <div class="mb-3">
            <label for="technologies_used" class="form-label text-white">Technologies used in the Project</label>
            <input
                type="text"
                class="form-control @error('technologies_used') is-invalid @enderror"
                id="technologies_used"
                name="technologies_used"
                value="{{ old('technologies_used', $project->technologies_used)}}"
                placeholder="Technologies used"
            >
        </div>

        <div class="mb-3">
            <label for="project_start" class="form-label text-white">Project start date</label>
            <input
                type="text"
                class="form-control @error('project_start') is-invalid @enderror"
                id="project_start"
                name="project_start"
                value="{{ old('project_start', $project->project_start)}}"
                placeholder="es.  YYYY/mm/dd"
            >
        </div>

        <div class="mb-3">
            <label for="end_of_project" class="form-label text-white">Project end date</label>
            <input
                type="text"
                class="form-control @error('end_of_project') is-invalid @enderror"
                id="end_of_project"
                name="end_of_project"
                value="{{ old('end_of_project', $project->end_of_project)}}"
                placeholder="es.  YYYY/mm/dd"
            >
        </div>


        <div class="mb-3">
            <label for="number_of_collaborators" class="form-label text-white">Numbers of Collaborators</label>
            <input
                type="number"
                class="form-control @error('number_of_collaborators') is-invalid @enderror"
                id="number_of_collaborators"
                name="number_of_collaborators"
                value="{{ old('number_of_collaborators', $project->number_of_collaborators)}}"
                placeholder="Number of collaborators"
            >
        </div>

        <button type="submit" class="btn btn-primary">Create</button>

    </form>


</div>

<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection
