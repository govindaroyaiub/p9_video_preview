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
                <h3 class="text-xl font-semibold tracking-wide">Add Logo</h3>

                <form class="max-w-lg" method="POST" action="/logo/add" enctype="multipart/form-data">
                    @csrf
                    <input type='text' placeholder="Enter Company Name" name="company_name"
                           class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                           required/>

                    <input type="file" name="logo_file"
                           class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary">

                    <div class="flex space-x-4">
                        <button type="submit"
                                class="w-1/2 mt-2 mb-6 bg-indigo-600 text-gray-200 text-lg rounded hover:bg-indigo-500 px-6 py-2 focus:outline-none">
                            Create
                        </button>
                        <button type="button" onclick="window.location.href='/logo';"
                                class="w-1/2 mt-2 mb-6 bg-green-600 text-gray-100 text-lg rounded hover:bg-green-500 px-6 py-2 focus:outline-none">
                            Back
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
