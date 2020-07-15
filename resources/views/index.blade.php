@extends('app')
@section('content')
	<div class="min-height pricing-header px-3 py-3 mx-auto">
		@if ( count( $stats ) > 0 )
			<h1 class="display-4">Strategies</h1>
			@include('layout.stats-list')
		@else
			<h1 class="display-4">No Stats Yet...</h1>
		@endif
	</div>
	<script src="/js/delete-confirm.js"></script>
@endsection