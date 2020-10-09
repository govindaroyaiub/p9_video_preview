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
            <h3 class="text-xl font-semibold tracking-wide">Resolution Sizes</h3>
            <div x-data="{ show: false }">
                <div class="flex justify-center">
                    <button @click={show=true} type="button"
                        class="leading-tight bg-primary text-gray-200 rounded px-6 py-3 text-sm focus:outline-none focus:border-white">Add Size</Button>
                </div>
                <div x-show="show" tabindex="0"
                    class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
                    <div @click.away="show = false" class="z-50 relative p-3 mx-auto my-0 max-w-full"
                        style="width: 600px;">
                        <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden">
                            <button @click={show=false}
                                class="fill-current h-6 w-6 absolute right-0 top-0 m-6 font-3xl font-bold">&times;</button>
                            <div class="px-6 py-3 text-xl border-b font-bold">Add Sizes</div>
                            <div class="p-6 flex-grow">
                                <p>You are watching this text in tailwind css model with alpine JS.</p>
                            </div>
                            <div class="px-6 py-3 border-t">
                                <div class="flex justify-end">
                                    <button @click={show=false} type="button"
                                        class="bg-gray-700 text-gray-100 rounded px-4 py-2 mr-1">Close</Button>
                                    <button type="submit" class="bg-blue-600 text-gray-200 rounded px-4 py-2">Saves
                                        Changes</Button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black opacity-50">
                    </div>
                </div>
            </div>
            <br>
            <table id="datatable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">No</th>
                        <th data-priority="2">Resolution</th>
                        <th data-priority="3">Actions</th>
                    </tr>
                </thead>
                <?php $i=1; ?>
                <tbody>
                @foreach( $size_list as $size )
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $size->width }}x{{ $size->height }}</td>
                        <td>Dummy Text</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
