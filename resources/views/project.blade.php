@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    @if (session('status'))
    <div class="bg-green-400 text-gray-900 px-2 py-1 rounded-lg" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="flex -mx-4">
        @include('sidebar')
        <div class="w-3/4 mx-4">
            @include('alert')
            <br>
            <div class="flex justify-between w-full">
                <h3 class="text-xl font-semibold tracking-wide">Projects</h3>
                <a href="/project/add">
                    <button type="button"
                        class="leading-tight bg-primary text-gray-200 rounded px-6 py-3 text-sm focus:outline-none focus:border-white">Add
                        Project</Button>
                </a>
            </div>
            <br>
            <table id="datatable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">No</th>
                        <th data-priority="2">Project Name</th>
                        <th data-priority="3">Client Name</th>
                        <th data-priority="4">Actions</th>
                    </tr>
                </thead>
                <?php $i=1; ?>
                <tbody>
                    @foreach($project_list as $project)
                    <tr style="text-align: center;">
                        <td>{{ $i++ }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->client_name }}</td>
                        <td>
                            <a href="/project/view/{{$project->id}}" target="_blank">
                                <button type="button"
                                    class="bg-green-500 text-gray-200 rounded hover:bg-green-400 px-4 py-2 focus:outline-none">View</button>
                            </a>
                            <a href="/project/delete/{{$project->id}}">
                                <button type="button"
                                    class="bg-red-500 text-gray-200 rounded hover:bg-red-400 px-4 py-2 focus:outline-none">Delete</button>
                            </a>
                            <a href="/project/settings/{{$project->id}}">
                                <button type="button"
                                    class="bg-gray-300 text-gray-900 rounded hover:bg-grey-400 px-4 py-2 focus:outline-none">Settings</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
