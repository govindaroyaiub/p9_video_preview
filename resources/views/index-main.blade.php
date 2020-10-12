<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $main_project_info['name'] }}</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>

<body class="font-body">
    <header class="header relative border-b border-primary">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div>
                <h3>Client Name: <span class="font-semibold">{{ $main_project_info['client_name'] }}</span></h3>
                <h3>Project Name: <span class="font-semibold">{{ $main_project_info['name'] }}</span></h3>
            </div>

            <div class="flex">
                @if($main_project_info->is_logo == 1)
                <img src="{{ asset('/logo_images/'.'/'.$main_project_info->path) }}"
                    alt="{{ $main_project_info['client_name'] }}" class="w-32 flex-none mr-4" />
                @else

                @endif
                <div x-data="{ commentModal: false }">
                    <svg @click.transition="commentModal = true" class="w-8 h-8 text-primary" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>

                    <div x-show="commentModal" @click.away="commentModal = false"
                        class="h-screen bg-white shadow absolute top-0 right-0 w-64 p-4 rounded-lg">
                        <svg class="w-8 h-8 text-red-400 font-semibold" @click="commentModal = false" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>

                        @if($comments_count == 0)
                        <p class="my-4">If you like this video feel free to feedback us!</p>
                        @else
                        <p class="my-4" style="text-decoration: underline;">Comments:</p>
                        @foreach($comments as $comment)
                        <textarea name="comment" id="comment" cols="5" rows="3"
                            class="w-full border bg-gray-300  border-gray-600 focus:outline-none rounded-lg"
                            readonly>{{ $comment->comment }}</textarea>
                        <br>
                        @endforeach
                        @endif
                        <form action="/comment/{{ $main_project_id }}" method="POST">
                            @csrf
                            <textarea name="comment" id="comment" cols="5" rows="5"
                                class="w-full border border-gray-600 focus:outline-none rounded-lg"></textarea>
                            <button type="submit" class="bg-primary px-4 py-2 rounded-lg w-full text-white mt-2">Comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-2">
        <div class="md:flex">
            @if(Auth::user())
            <a href="/home" target="_blank"> Dashboard </a>
            <a href="/project/addon/{{ $main_project_id }}"> Add More + </a>
            @endif
        </div>
    </div>

    <main class="main">
        @foreach($sub_project_info as $project)
        <div class="container mx-auto px-4 py-10">
            <div class="flex -mx-8 mb-10">
                <div class="w-3/4 mx-8">
                    <div class="videos">
                        <h2 class="text-xl font-semibold mb-4">
                            {{ $project->title }}
                        </h2>
                        <div class="video-container aspect-ratio-16-9">
                            <video class="video" playsinline controls data-poster="poster.jpg" @if($project->width >=
                                1980) width="560" height="315" @elseif($project->width < 1980) width="560" height="100"
                                    @endif>
                                    <source src="{{ asset('/banner_videos/'.'/'.$project->video_path) }}"
                                        type="video/mp4" />
                            </video>
                        </div>
                        <div class="md:flex">
                            <a href="{{ asset('/banner_videos/'.'/'.$project->video_path) }}"
                                class="color-primary underline flex mt-4" download>Download Video
                                <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                            @if(Auth::user())
                            <a href="/video/edit/{{ $project->id }}" class="color-primary underline flex mt-4">Edit
                                <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                            <a href="/video/delete/{{ $project->id }}" class="color-primary underline flex mt-4">Delete
                                <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="w-1/4 mx-8">
                    <h2 class="text-xl font-semibold mb-8" style="text-decoration: underline;">Specifications:</h2>
                    <table class="table w-full">
                        <tbody>
                            <tr>
                                <td>Aspect Ratio:</td>
                                <td>{{ $project->aspect_ratio }}</td>
                            </tr>
                            <tr>
                                <td>Resolution (WxH):</td>
                                <td>{{ $project->width }}x{{ $project->height }}</td>
                            </tr>
                            <tr>
                                <td>Codec:</td>
                                <td>{{ $project->codec }}</td>
                            </tr>
                            <tr>
                                <td>Framerate:</td>
                                <td>{{ $project->fps }}</td>
                            </tr>
                            <tr>
                                <td>Size:</td>
                                <td>{{ $project->size }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if($project->poster_path != NULL)
                    <div class="mt-4">
                        <div class="companion-banner">
                            <h2 class="text-xl font-semibold mb-4">{{ $project->size_name }}</h2>

                            <img class="block" src="{{ asset('/poster_images/'.'/'.$project->poster_path) }}" alt="companion banner">

                            <a href="{{ asset('/poster_images/'.'/'.$project->poster_path) }}"
                                class="color-primary underline flex mt-2" download>Download
                                <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </main>

    @if($main_project_info->is_footer == 1)
    <footer class="footer bg-primary">
        <div class="container mx-auto px-4 py-3 text-white text-center">&copy; All Right Reserved. <a
                href="https://www.planetnine.com/" target="_blank" style="text-decoration: underline;">Planet Nine</a>
            - <?= Date('Y') ?></div>
    </footer>
    @else

    @endif

    <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
