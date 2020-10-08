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
                <h3 class="text-xl font-semibold tracking-wide">Projects</h3>  
                <a class="rounded-lg hover:bg-primary hover:text-white py-2 block" href="/project/add">Project</a>
                <br>
                <table id="project_table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead>
						<tr>
							<th data-priority="1">Project Name</th>
							<th data-priority="2">Client Name</th>
							<th data-priority="3">Actions</th>
							
					</thead>
					<tbody>
						<tr>
							<td>Tina May</td>
							<td>Coffee Manager</td>
							<td>Ljubljana</td>
						</tr>
						
						<!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->
						
						<tr>
							<td>Donna Snider</td>
							<td>Customer Support</td>
							<td>New York</td>
						</tr>
					</tbody>
					
				</table>



            </div>
        </div>
    </div>
@endsection
