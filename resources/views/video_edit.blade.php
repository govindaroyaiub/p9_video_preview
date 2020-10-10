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
            <h3 class="text-xl font-semibold tracking-wide">Edit Video</h3>
            <h3 class="text-xl font-semibold tracking-wide text-red-500">Just Edit What You Need to Edit Or Replace The Assets</h3>
            <br>
            <form method="POST" action="/project/addon/{{ $sub_project_id }}" enctype="multipart/form-data">
                @csrf
                <label class="text-primary font-light">Advertising Format</label><br>
                <select name="size_id"
                    class="w-2/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" required>
                    <option value="0" class="py-2">Select Size</option>
                    @foreach($size_list as $size)
                    <option value="{{ $size->id }}" @if($sub_project_info['size_id'] == $size->id) selected @else '' @endif) class="py-2">{{ $size->name }} (
                        {{ $size->width }}x{{ $size->height }} )</option>
                    @endforeach
                </select>

                <div class="flex mb-4">
                    <input type='text' placeholder="Enter Codec" name="codec" value="{{ $sub_project_info['codec'] }}"
                        class="w-1/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" required/>
                    <input type='text' placeholder="Enter Aspect Ratio" name="aspect_ratio" value="{{ $sub_project_info['aspect_ratio'] }}"
                        class="w-1/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" required/>
                </div>

                <div class="flex mb-4">
                    <input type='text' placeholder="Enter Frame Per Second" name="fps" value="{{ $sub_project_info['fps'] }}"
                        class="w-1/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" required/>
                    <input type='text' placeholder="Enter Video Size" name="size" value="{{ $sub_project_info['size'] }}"
                        class="w-1/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" required/>
                </div>

                <label class="text-primary font-light">Select Companion Banner Poster</label><br>
                <input type="file" name="poster"
                    class="w-2/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary">
                <br>

                <label class="text-primary font-light">Select Video File</label><br>
                <input type="file" name="video"
                    class="w-2/3 mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary" required>

                <div class="flex mb-4">
                    <button type="submit"
                        class="w-1/3 mt-2 mb-6 bg-blue-600 text-gray-200 text-lg rounded hover:bg-blue-500 px-6 py-3 focus:outline-none">Create</button>
                    <button type="button" onclick="window.location.href='/project/view/{{ $sub_project_info['project_id'] }}';"
                        class="w-1/3 mt-2 mb-6 bg-red-600 text-gray-100 text-lg rounded hover:bg-red-500 px-6 py-3 focus:outline-none">Back</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
