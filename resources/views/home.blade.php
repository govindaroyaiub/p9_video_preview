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
                <h3 class="text-xl font-semibold tracking-wide">{{ __('Dashboard') }}</h3>

                <div class="grid grid-cols-3 gap-8 mt-4">
                    <div class="bg-blue-400 p-2 rounded-lg text-center shadow-sm">
                        <h3 class="text-gray-800 text-2xl">Total Projects</h3>
                        <h2 class="text-blue-800 text-3xl font-bold">{{ $total_projects }}</h2>
                    </div>
                    <div class="bg-green-400 p-2 rounded-lg text-center shadow-sm">
                        <h3 class="text-gray-800 text-2xl">Total Videos</h3>
                        <h2 class="text-green-800 text-3xl font-bold">{{ $total_videos }}</h2>
                        <hr>
                        <h3 class="text-gray-800 text-2xl">Total Video Space</h3>
                        <h2 class="text-blue-800 text-3xl font-bold">{{ $total_number }} MB</h2>
                    </div>
                    <div class="bg-red-400 p-2 rounded-lg text-center shadow-sm">
                        <h3 class="text-gray-800 text-2xl">Total Comments</h3>
                        <h2 class="text-red-800 text-3xl font-bold">{{ $total_comments }}</h2>
                    </div>
                </div>

                <br>
                <br>
                
                <div class="flex justify-between w-full">
                    <h3 class="text-xl font-semibold tracking-wide">Users</h3>
                    <a href="/user/add">
                        <button type="button"
                            class="leading-tight bg-primary text-gray-200 rounded px-6 py-3 text-sm focus:outline-none focus:border-white">Add
                            User</Button>
                    </a>
                </div>

                <br>

                <table id="datatable" class="stripe hover table w-full" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="bg-gray-200 px-4 py-2">No.</th>
                        <th class="bg-gray-200 px-4 py-2">Name</th>
                        <th class="bg-gray-200 px-4 py-2">Email</th>
                        <th class="bg-gray-200 px-4 py-2">Action</th>
                    </tr>
                    </thead>
                    <?php $i=1; ?>
                    <tbody>
                    @foreach($user_list as $user)
                        <tr style="text-align: center;">
                            <td class="border px-4 py-2">{{$i++}}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">Action</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
