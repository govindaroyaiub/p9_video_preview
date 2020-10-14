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

            <div class="w-3/5 mx-4">
                <h3 class="text-xl font-semibold tracking-wide mb-4">Add Project</h3>

                <form id="project-add-form" class="max-w-xl" method="POST" action="/project/add"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="text-primary font-light block">Project Name</label>
                        <input type='text' placeholder="Enter Project Name" name="project_name"
                               class="w-full mt-2 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                               required/>
                    </div>


                    <div class="mb-4">
                        <label class="text-primary font-light block">Client Name</label>
                        <input type='text' placeholder="Enter Client Name" name="client_name"
                               class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                               required/>

                    </div>


                    <div class="mb-4">

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-primary font-light block mb-3">Select Logo</label>
                                <select name="logo_id"
                                        class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                                >
                                    <option value="0" class="py-2">Select Logo</option>
                                    @foreach($logo_list as $logo)
                                        <option value="{{ $logo->id }}" class="py-2">{{ $logo->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="text-primary font-light block">Select Color</label>
                                <small class="text-xs text-gray-600">(Default selected Color is PlanetNine Logo
                                    Color)</small>
                                <input type='color' name="color" value="#4c4f6d"
                                       class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg" required/>
                            </div>
                        </div>
                    </div>


                    <div class="mb-4">
                        <label class="text-primary font-light block">Video Title (example: Pre-Roll/Bumper Interstitial
                            for
                            Youtube)</label>
                        <input type='text' placeholder="Enter Video Title" name="title"
                               class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                               required/>
                    </div>


                    <div class="mb-4">
                        <label class="text-primary font-light block">Advertising Format</label>
                        <select name="size_id"
                                class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                        >
                            <option value="0" class="py-2">Select Size</option>
                            @foreach($size_list as $size)
                                <option value="{{ $size->id }}" class="py-2">{{ $size->name }} (
                                    {{ $size->width }}x{{ $size->height }} )
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex space-x-4">
                        <input type='text' placeholder="Enter Codec" name="codec"
                               class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                               required/>
                        <input type='text' placeholder="Enter Aspect Ratio" name="aspect_ratio"
                               class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                               required/>
                    </div>

                    <div class="flex space-x-4">
                        <input type='text' placeholder="Enter Frame Per Second" name="fps"
                               class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                               required/>
                        <input type='text' placeholder="Enter Video Size" name="size"
                               class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                               required/>
                    </div>

                    <div>
                        <label class="text-primary font-light block">Select Companion Banner Poster</label>
                        <input type="file" name="poster"
                               class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-primary"
                               required/>
                    </div>

                    <div class="drag-n-drop-area relative opacity-50 border border-dashed border-primary rounded-lg w-full">
                        <input type="file" name="video" class="drag-n-drop absolute mx-auto text-center" id="upload"/>
                    </div>

                    <div class="flex space-x-4 mt-4">
                        <button type="submit"
                                class="w-full mt-2 mb-6 bg-indigo-700 text-gray-200 text-lg rounded hover:bg-indigo-500 px-6 py-2 focus:outline-none">
                            Create
                        </button>
                        <button type="button" onclick="window.location.href='/project';"
                                class="w-full mt-2 mb-6 bg-green-600 text-gray-100 text-lg rounded hover:bg-green-500 px-6 py-2 focus:outline-none">
                            Back
                        </button>
                    </div>

                </form>
            </div>
        </div>

        @endsection


        @section('script')
            <script>
                var upload = document.querySelector('.drag-n-drop');

                function onFile() {
                    var me = this,
                        file = upload.files[0],
                        name = file.name.replace(/\.[^/.]+$/, '');

                    if (file.type === '' || file.type === 'video/mp4') {
                        if (file.size < (500000 * 1024)) {
                            upload.parentNode.className = 'drag-n-drop-area uploading';
                        } else {
                            window.alert('File size is too large, please ensure you are uploading a file of less than 3MB');
                        }
                    } else {
                        window.alert('File type ' + file.type + ' not supported');
                    }
                }

                upload.addEventListener('dragenter', function (e) {
                    upload.parentNode.className = 'drag-n-drop-area dragging';
                }, false);

                upload.addEventListener('dragleave', function (e) {
                    upload.parentNode.className = 'drag-n-drop-area';
                }, false);

                upload.addEventListener('dragdrop', function (e) {
                    onFile();
                }, false);

                upload.addEventListener('change', function (e) {
                    onFile();
                }, false);
            </script>
@endsection
