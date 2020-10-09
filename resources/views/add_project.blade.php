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
            <h3 class="text-xl font-semibold tracking-wide">Add Sizes</h3>
            <br>
            <form method="POST" action="/sizes/add">
            @csrf
            <input type='text' placeholder="Enter Size Name" name="size_name"
                class="w-2/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" />

            <div class="flex mb-4">
                <input type='text' placeholder="Enter Width" name="width"
                    class="w-1/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" />
                <input type='text' placeholder="Enter Height" name="height"
                    class="w-1/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" />
            </div>

            <div class="flex mb-4">
                <input type='text' placeholder="Enter Front Width" name="front_width"
                    class="w-1/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" />
                <input type='text' placeholder="Enter Front Height" name="front_height"
                    class="w-1/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" />
            </div>

            <div class="flex mb-4">
                <button type="submit"
                    class="w-1/3 mt-2 mb-6 bg-blue-600 text-gray-200 text-lg rounded hover:bg-blue-500 px-6 py-3 focus:outline-none">Create</button>
                <button type="button" onclick="window.location.href='/sizes';"
                    class="w-1/3 mt-2 mb-6 bg-red-600 text-gray-100 text-lg rounded hover:bg-red-500 px-6 py-3 focus:outline-none">Back</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
