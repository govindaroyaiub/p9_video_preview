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
                <h3 class="text-xl font-semibold tracking-wide">Clients</h3>
                <a href="/client/add">
                    <button type="button"
                        class="leading-tight bg-primary text-gray-200 rounded px-6 py-3 text-sm focus:outline-none focus:border-white">Add
                        Client</Button>
                </a>
            </div>
            <br>
            <table id="datatable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">Name</th>
                        <th data-priority="2">Logo</th>
                        <th data-priority="3">Actions</th>

                </thead>
                <tbody>
                    <tr style="text-align: center;">
                        <td>Merkle</td>
                        <td>Logo</td>
                        <td>Ljubljana</td>
                    </tr>

                    <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->

                    <tr style="text-align: center;">
                        <td>Fusion Lab</td>
                        <td>Customer Support</td>
                        <td>New York</td>
                    </tr>
                </tbody>

            </table>



        </div>
    </div>
</div>
@endsection
