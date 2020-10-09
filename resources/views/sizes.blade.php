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
                <h3 class="text-xl font-semibold tracking-wide">Resolution Sizes</h3>
                <a href="/sizes/add">
                    <button type="button"
                        class="leading-tight bg-primary text-gray-200 rounded px-6 py-3 text-sm focus:outline-none focus:border-white">Add
                        Size</Button>
                </a>
            </div>
            <br>
            <table id="datatable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">No</th>
                        <th data-priority="2">Name</th>
                        <th data-priority="2">Resolution</th>
                        <th data-priority="3">Actions</th>
                    </tr>
                </thead>
                <?php $i=1; ?>
                <tbody>
                    @foreach( $size_list as $size )
                    <tr style="text-align: center;">
                        <td>{{ $i++ }}</td>
                        <td>{{ $size->name }}</td>
                        <td>{{ $size->width }}x{{ $size->height }}</td>
                        <td>
                            <a href="/sizes/delete/{{$size->id}}">
                                <button type="button"
                                    class="bg-red-500 text-gray-200 rounded hover:bg-red-400 px-4 py-2 focus:outline-none">Delete</button>
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
