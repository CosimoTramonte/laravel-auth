@extends('layouts.admin')

@section('content')
<div class="container p-5">
    <h2 class="fs-4 my-4">
        Project List
    </h2>

    <table class="table table-dark table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">#ID</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Technologies used</th>
            <th scope="col">Project start date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{$project->id}}</th>
                    <td>{{$project->name}}</td>
                    <td>{{$project->type}}</td>
                    <td>{{$project->technologies_used}}</td>
                    @php
                        $dateOfStart = date_create($project->project_start);
                    @endphp
                    <td>{{ date_format($dateOfStart, 'd/m/Y') }}</td>
                    <td>
                        <a href="{{route('admin.projects.show', $project)}}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $projects->links() }}
    </div>

</div>
@endsection
