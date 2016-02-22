@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h3> {{ $event['name'] }} </h3></div>

				<ul class="nav nav-tabs" id="myTabs">
                    <li  ><a href="#tab1" data-toggle="tab">Event Description</a></li>
                    <li><a href="#tab2" data-toggle="tab">Event Poll</a></li>
                    <li><a href="#tab3" data-toggle="tab">Items List</a></li>
                    <li><a href="#tab4" data-toggle="tab">People</a></li>
                    <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                    <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                    <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
                </ul>

                <div class="tab-content">
                	<div class="tab-pane" id="tab1">
                		
						<br>
						<ul>
							<li> Date:{{ $event['date'] }} </li>
							<li> Start Time: {{ $event['stime']}} End Time: {{ $event['etime']}} </li>
							<li> Location: {{ $event['location'] }} </li>
							<li> Description: {{ $event['description'] }} </li>
						</ul>
                	</div>
                	<div class="tab-pane" id="tab2">
                		<h4>Polls</h4>
						@if (count($all_options))
						@foreach($all_options as $options)
						@include('polls.poll_display', $options )
						@endforeach
						@else
						<p>This event has no polls.</p>
						@endif
                	</div>
                	<div class="tab-pane" id="tab3">
                		<h4>Items list</h4>
                	</div>
                	<div class="tab-pane" id="tab4">
                		<h4>Invited</h4>
						<div>
							@if (count($invites))
							<ul>
								@foreach($invites as $person)
								<li>{{print_r($person, true)}}</li>
								@endforeach
							</ul>
							@else
							<p>This event has no invitees.</p>
							@endif
						</div>
                	</div>
               	</div>
			</div>
		</div>
	</div>
</div>
@endsection
