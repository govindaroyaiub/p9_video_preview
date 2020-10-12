<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>P9 Video</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        /*Form fields*/
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568; /*text-gray-700*/
            padding-left: 1rem; /*pl-4*/
            padding-right: 1rem; /*pl-4*/
            padding-top: .5rem; /*pl-2*/
            padding-bottom: .5rem; /*pl-2*/
            line-height: 1.25; /*leading-tight*/
            border-width: 2px; /*border-2*/
            border-radius: .25rem;
            border-color: #edf2f7; /*border-gray-200*/
            background-color: #edf2f7; /*bg-gray-200*/
        }

        /*Row Hover*/
        table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff; /*bg-indigo-100*/
        }

        /*Pagination Buttons*/
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700; /*font-bold*/
            border-radius: .25rem; /*rounded*/
            border: 1px solid transparent; /*border border-transparent*/
        }

        /*Pagination Buttons - Current selected */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important; /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06); /*shadow*/
            font-weight: 700; /*font-bold*/
            border-radius: .25rem; /*rounded*/
            background: #667eea !important; /*bg-indigo-500*/
            border: 1px solid transparent; /*border border-transparent*/
        }

        /*Pagination Buttons - Hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important; /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06); /*shadow*/
            font-weight: 700; /*font-bold*/
            border-radius: .25rem; /*rounded*/
            background: #667eea !important; /*bg-indigo-500*/
            border: 1px solid transparent; /*border border-transparent*/
        }

        /*Add padding to bottom border */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0; /*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }

        /*Change colour of responsive icon*/
        table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before, table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child:before {
            background-color: #667eea !important; /*bg-indigo-500*/
        }

    </style>
</head>
<body class="bg-gray-100 min-h-screen font-body">
<nav class="bg-white">
    <div class="relative container mx-auto px-4 py-3 flex justify-between items-center">
        @if(Auth::user())
            <a class="text-xl font-semibold" href="{{ url('/') }}">
                <img src="{{ asset('/images/logo.png') }}" style="max-width: 20.6%">
            </a>
        @endif

        <ul class="flex space-x-4">
            @guest

            @else
                <div x-data="{ logout: false}">

                    <button @click="logout = true" class="focus:outline-none">{{ Auth::user()->name }}</button>

                    <div class="absolute bg-white shadow-md rounded-lg p-6" x-show="logout" @click.away="logout = false">
						<a href="/change-password">
						Change Password
						</a>
						<hr>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </ul>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>


<script src="{{ asset('js/app.js') }}"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#datatable').DataTable({
            responsive: true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        })
            .columns.adjust();
    });
</script>
</body>
</html>
