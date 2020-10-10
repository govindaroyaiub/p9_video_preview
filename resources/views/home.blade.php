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

                <h3 class="text-xl font-semibold tracking-wide mt-4">Users</h3>
                <table class="table w-full">
                    <thead>
                    <tr>
                        <th class="bg-gray-200 px-4 py-2">No.</th>
                        <th class="bg-gray-200 px-4 py-2">Name</th>
                        <th class="bg-gray-200 px-4 py-2">Email</th>
                        <th class="bg-gray-200 px-4 py-2">Role</th>
                    </tr>
                    </thead>
                    <?php $i=1; ?>
                    <tbody>
                    @foreach($user_list as $user)
                        <tr style="text-align: center;">
                            <td class="border px-4 py-2">{{$i++}}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">Admin</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
