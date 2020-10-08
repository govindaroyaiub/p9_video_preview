@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        @if (session('status'))
            <div class="bg-green-400 text-gray-900 px-2 py-1 rounded-lg" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex -mx-4">
            <div class="w-1/4 mx-4 bg-gray-200 rounded-lg flex flex-col justify-between" style="min-height: 87vh;">
                <ul class="space-y-2">
                    <li><a class="rounded-lg hover:bg-primary hover:text-white px-3 py-2 block" href="#">Dashboard</a>
                    </li>
                    <li><a class="rounded-lg hover:bg-primary hover:text-white px-3 py-2 block" href="#">Profile</a>
                    </li>
                    <li><a class="rounded-lg hover:bg-primary hover:text-white px-3 py-2 block" href="#">Upload
                            Videos</a></li>
                    <li><a class="rounded-lg hover:bg-primary hover:text-white px-3 py-2 block" href="#">Show Stats</a>
                    </li>
                    <li><a class="rounded-lg hover:bg-primary hover:text-white px-3 py-2 block" href="#">Users</a></li>
                </ul>

                <div class="text-center text-sm text-gray-700 mb-2">&copy; Planetnine - 2020</div>
            </div>
            <div class="w-3/4 mx-4">
                <h3 class="text-xl font-semibold tracking-wide">{{ __('Dashboard') }}</h3>

                <div class="grid grid-cols-3 gap-8 mt-4">
                    <div class="bg-blue-400 p-2 rounded-lg text-center shadow-sm">
                        <h3 class="text-gray-800 text-2xl">your stats</h3>
                        <h2 class="text-blue-800 text-3xl font-bold">34</h2>
                    </div>
                    <div class="bg-green-400 p-2 rounded-lg text-center shadow-sm">
                        <h3 class="text-gray-800 text-2xl">your videos</h3>
                        <h2 class="text-green-800 text-3xl font-bold">12</h2>
                    </div>
                    <div class="bg-red-400 p-2 rounded-lg text-center shadow-sm">
                        <h3 class="text-gray-800 text-2xl">your shares</h3>
                        <h2 class="text-red-800 text-3xl font-bold">8</h2>
                    </div>
                </div>

                <h3 class="text-xl font-semibold tracking-wide mt-4">Users</h3>
                <table class="table w-full">
                    <thead>
                    <tr>
                        <th class="bg-gray-200 px-4 py-2">Name</th>
                        <th class="bg-gray-200 px-4 py-2">Email</th>
                        <th class="bg-gray-200 px-4 py-2">Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="border px-4 py-2">Maarten Roelofs</td>
                        <td class="border px-4 py-2">maarten.roelofs@gmail.com</td>
                        <td class="border px-4 py-2">Admin</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Ebn Sina</td>
                        <td class="border px-4 py-2">ebnsina@gmail.com</td>
                        <td class="border px-4 py-2">User</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Govinda Roy</td>
                        <td class="border px-4 py-2">gopi@gmail.com</td>
                        <td class="border px-4 py-2">Admin</td>
                    </tr>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
