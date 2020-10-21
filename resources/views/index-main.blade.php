<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $main_project_info['name'] }}</title>
    <link rel="shortcut icon" href="https://www.planetnine.com/wp-content/uploads/2020/06/cropped-favicon-32x32.png"
          type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #4c4f6d;
            width: 80px;
            height: 80px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
            margin: 0 auto !important;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        function list_comments() {
            $(".loader").hide();
            $.ajax({
                url: '/get_comments/' +{{ $main_project_id }},
                type: 'get',
                success: function (result) {
                    if (result) {
                        $("#not_needed").css("display", "none");
                        $('.comment_listing').html(result);
                    }
                }
            })
        }

        $(function () {
            list_comments();
            setInterval(function () {
                list_comments();
            }, 6000);
            $('.submit').click(function () {
                var comment = $('.comment').val();
                show_loader();
                $.ajax({
                    url: '/store_comments/' +{{ $main_project_id }},
                    data: {
                        comment: comment,
                        _token: '{{csrf_token()}}'
                    },
                    type: 'post',
                    success: function () {
                        $('.comment').val('').change();
                        list_comments();
                    }
                })
            })
        })

        function show_loader() {
            $("#comment_button").hide();
            setTimeout(hide_loader, 4500);
            $(".loader").show();
        }

        function hide_loader() {
            $(".loader").hide();
            $("#comment_button").show();
        }
    </script>
</head>

<body class="font-body">
<header class="header relative border-b" style="border-color: {{ $main_project_info['color'] }}">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div>
            <h3>Client Name: <span class="font-semibold">{{ $main_project_info['client_name'] }}</span></h3>
            <h3>Project Name: <span class="font-semibold">{{ $main_project_info['name'] }}</span></h3>
        </div>

        <div class="flex">
            @if($main_project_info->is_logo == 1)
                <img src="{{ asset('/logo_images/'.'/'.$main_project_info->path) }}"
                     alt="{{ $main_project_info['client_name'] }}" class="w-32 flex-none mr-4"/>
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
                    <div x-show="commentModal" @click.away="commentModal = false"
                         class="h-screen bg-white shadow absolute top-0 right-0 w-64 p-4 rounded-lg" id="comment_modal">
                        <svg class="w-8 h-8 text-red-400 font-semibold" @click="commentModal = false" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>

                        <div id="not_needed">
                            <p class="my-4">If you like this video feel free to feedback us!</p>
                        </div>
                        <div>
                            <p class="my-4" style="text-decoration: underline;">Comments:</p>
                            <div class="comment_listing">
                            </div>
                            <textarea name="comment_content" id="comment" cols="5" rows="5"
                                      class="comment w-full border border-gray-600 focus:outline-none rounded-lg"></textarea>
                            <br>
                            <a href="javascript:void(0)" id="comment_button"
                               class="submit bg-primary px-20 py-2 rounded-lg w-full text-white mt-2">Comment
                            </a>
                            <br>
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</header>

<div class="container mx-auto px-4 py-2">
    @if(Auth::user())
        <ul class="flex space-x-4">
            <li><a class="flex" href="/home" target="_blank">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span></a></li>
            <li><a class="flex" href="/project/addon/{{ $main_project_id }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Add More</span></a>
            </li>
        </ul>
    @endif
</div>

<main class="main">
    @foreach($sub_project_info as $project)
        <div class="container mx-auto px-4 py-10">
            <div class="md:flex -mx-8 mb-10">
                @if($project->width == 1920 && $project->height == 1080)
                    @include('1920_1080')
                @elseif(($project->width == 1080 && $project->height == 1080) || ($project->width == 1280 && $project->height == 720))
                    @include('1080_1080')
                @elseif($project->width == 720 && $project->height == 1280)
                    @include('720_1280')
                @endif
                <div class="md:w-1/4 mx-8">
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
                                <h2 class="text-xl font-semibold mb-4">Companion Banner</h2>

                                <img class="block" src="{{ asset('/poster_images/'.'/'.$project->poster_path) }}"
                                     alt="companion banner">

                                <a href="{{ asset('/poster_images/'.'/'.$project->poster_path) }}"
                                   class="color-primary underline flex mt-2" download>Download Banner
                                    <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
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
    <footer class="footer" style="background-color: {{ $main_project_info['color'] }}">
        <div class="container mx-auto px-4 py-3 text-white text-center">&copy; All Right Reserved. <a
                href="https://www.planetnine.com/" target="_blank" style="text-decoration: underline;">Planet Nine</a>
            - <?= Date('Y') ?></div>
    </footer>
@endif
<script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
