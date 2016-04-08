@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<?php
				//Decode data from api
				$array = json_decode(json_encode($data), true);//Do a quick object type conversion to get our array
				$event = $array['event'];
				$all_options = $array['all_poll_options'];
				$items_list = $array['items'];
				$invites = $array['invites'];
				$chat_messages = $array['chat_messages'];
				$item_users = $array['item_users'];
				$rsvp_status = $array['userRSVP'];
				$ticketcost = $array['ticketcost'];

				?>
				<div class="panel-heading"><h3> {{ $event['name'] }} </h3></div>

				<ul class="nav nav-tabs" id="myTabs">
                    <li  ><a href="#tab1" data-toggle="tab">Event Description</a></li>
                    <li><a href="#tab2" data-toggle="tab">Event Poll</a></li>
                    <li><a href="#tab3" data-toggle="tab">Items List</a></li>
                    <li><a href="#tab4" data-toggle="tab">People</a></li>
                </ul>

                <div class="tab-content">
                	<div class="tab-pane" id="tab1">
						@include('tab_detail.event_details', $event)
                	</div>

                	<div class="tab-pane" id="tab2">
						<div class="event-details">
							<h4>Dates</h4>
							@if (count($all_options))
								@if ($event['uid'] == Auth::user()->uid)
									@foreach($all_options as $options)
										@include('polls.poll_display', $options )
									@endforeach
								@else
									@foreach($all_options as $options)
										@include('polls.poll_vote', $options )
									@endforeach
								@endif
							@else
								<p>This event has no polls.</p>
							@endif
						</div>
                	</div>

                	<div class="tab-pane" id="tab3">
                		@include('tab_detail.item_list',$items_list)
                	</div>

                	<div class="tab-pane" id="tab4">
						@include('tab_detail.invitee_list',$invites)
					</div>
				</div>
			</div>
				<h4>Messages</h4>
				@include('partials.chat_box',array('chat_message' => $chat_messages))
				<div class="form-group" >
					@include('tab_detail.messages',$event)
				</div>
			</div>
		</div>
	</div>
@endsection
