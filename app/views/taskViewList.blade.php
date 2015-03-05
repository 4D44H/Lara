{{-- Need variables: schedule  --}}

@extends('layouts.master')

@section('title')
	Aufgaben (Liste)
@stop

@section('content')

@if(Session::has('userId'))

<center>{{ $schedules->links() }}</center>

<a href="{{ Request::getBasePath() }}/task/create" class="btn btn-primary">Neue Aufgabe hinzufügen</a>

<div class="panel">
	<table class="table table-striped table-hover shadow">
		<thead>
		    <tr>
		      	<th class="col-md-0">#</th>

		      	<th class="col-md-0">&nbsp;</th>

	      		<th class="col-md-9">Aufgabe</th>

		      	<th class="col-md-3">Fällig am</th>
		    </tr>
		</thead>
		<tbody>
	

		@foreach($schedules as $schedule)
			<tr>
				<td> {{ $schedule->id; }} </td>	

				<td style="padding-top: 15px; padding-right: 5px;"> @if($schedule->schdl_password != '') <i class="fa fa-key"></i> @endif </td>		
				
				<td>
					<a href="{{ Request::getBasePath() }}/task/id/{{ $schedule->id }}">
						<b>{{{ $schedule->schdl_title }}}</b>
					</a>
				</td>

				<td><b>{{ strftime("%a, %d. %b", strtotime($schedule->schdl_due_date)) }}</b></td>
			</tr>
		
		@endforeach

		</tbody>	
	</table>
</div>
@else
	{{-- Access for club members only --}}
	@include('partials.accessDenied')
@endif
@stop
					