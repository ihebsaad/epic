@extends('layouts.app')

   <link href="{{ URL::asset('public/css/app.css') }}" rel="stylesheet">
	 <link href="{{ URL::asset('public/css/styles.css') }}" rel="stylesheet">

	 
    <link href="{{ URL::asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('/public/js/app.js') }}"></script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
