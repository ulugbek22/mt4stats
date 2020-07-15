@extends('app')
@section('content')
	<div class="container">
		<h4>{{ $data['name'] }}</h4>
		<p>{{ $data['bot_name'] }} | {{ $data['server_name'] }}</p>
		<p>{{ $data['symbol_name'] }} {{ $data['timeframe'] }} - {{ $data['period'] }}</p>
		<p><i>{{ $data['parameters'] }}</i></p>
		@include('layout.table')
		<hr>
		@include('layout.chart')
		<hr>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#trades" role="tab" aria-controls="home" aria-selected="true">Trades List</a>
		  </li>
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#daily-view" role="tab" aria-controls="profile" aria-selected="false">Daily View</a>
		  </li>
		</ul>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="trades" role="tabpanel" aria-labelledby="home-tab">
		  	@include('layout.trades')
		  </div>
		  <div class="tab-pane fade" id="daily-view" role="tabpanel" aria-labelledby="profile-tab">
		  	Here goes the freakin daily stats
		  </div>
		</div>
	</div>
@endsection