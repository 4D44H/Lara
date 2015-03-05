{{-- Need variables: entries, schedule, persons, clubs --}}

@extends('layouts.master')

@section('title')
	Dienstplan ID: {{ $schedule->id }}
@stop

@section('content')

@if(Session::has('userGroup'))
		<br />
		<div>						
			<a href="{{ Request::getBasePath() }}/task/id/{{ $schedule->id }}/edit" 
			   class="btn btn-primary">Aufgabe ändern</a>
			<a href="{{ Request::getBasePath() }}/task/id/{{ $schedule->id }}/delete" 
			   onclick="confirmation();return false;" 
			   class="btn btn-default">Aufgabe löschen</a>
			<script type="text/javascript">
				
				function confirmation() {
					if (confirm("Willst du diese Aufgabe wirklich löschen?")){
						window.location = "{{ Request::getBasePath() }}/task/id/{{ $schedule->id }}/delete";
					}
				}
				
			</script>
		</div>
@endif
<div class="panel">
	<div class="panel-heading">
		<h4 class="panel-title">
		@if($schedule->evnt_id != NULL)
			{{{ $schedule->getClubEvent->evnt_title }}}
		@else
			{{{ $schedule->schdl_title }}}
		@endif
		</h4>
	</div>
	<div class="panel-body">
		@if($schedule->evnt_id != NULL)
			<i>DV-Zeit:</i> {{ date("H:i", strtotime($schedule->schdl_time_preparation_start)) }}
			<br />
			<i>Ort:</i> {{{ $schedule->getClubEvent->getPlace->plc_title }}}
		@else
			<i>Fällig am:</i> {{ strftime("%a, %d. %b", strtotime($schedule->schdl_due_date)) }}
		@endif
	</div>

	{{ Form::model($entries, array('action' => array('ScheduleController@updateSchedule', $schedule->id))) }}

	@if( $schedule->schdl_password != '')	
		<br />
		<div class="well col-md-5">Eintragen nur mit gültigem Passwort:
		{{ Form::password('password') }}
		</div>
	@endif


	<table class="table table-striped">
		<thead>
		<tr>
			<th class="col-md-2">
				Dienst
			</th>
			<th class="col-md-8">
				Name
			</th>
			<th class="col-md-2">
				Verein
			</th>
		</tr>
		</thead>

		<tbody>
			@include('partials.jobsByScheduleId', $entries)
		</tbody>
	</table>

	{{ Form::submit('Änderungen speichern', array('class'=>'btn btn-primary')) }}
	{{ Form::close() }}
</div>
@stop