@extends('app')
@section('content')
	<div class="min-height pricing-header px-3 py-3 mx-auto">
		@if ( count( $stats ) > 0 )
			<h1 class="display-4">Graph List</h1>
			@include('layout.graphs')
		@else
			<h1 class="display-4">No Graphs Yet...</h1>
		@endif
	</div>
@endsection