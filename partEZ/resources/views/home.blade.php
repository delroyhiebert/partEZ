@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!

                   <!-- <a href="{{ url('/success') }}" role="button">Send Email</a> -->

                    <br><br>
                    <button href="{{ route('email') }}" type="button" class="btn btn-default">Send Email</button>
                    <br><br>
                    <button type="button" onclick="window.location='{{ url("/create_event") }}'">Create a new Event</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
