@extends('app')
@section('content')
<div class="min-height container pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Create New Stats</h1>
  <form class="create-form" action="/stats" method="post">
  	@csrf
	  <div class="form-group">
	    <label for="name">Name</label>
	    <input type="text" class="form-control" id="name" name="name">
	    <small id="name" class="form-text text-muted">Name of the robot.</small>
	  </div>
	  <div class="form-group">
	    <label for="data">Copied Data From MT4 Strategy Tester</label>
	    <textarea class="form-control" id="data" rows="6" name="data" required></textarea>
	  </div>
	  <button type="submit" class="btn btn-primary">Create</button>
	</form>
</div>
@endsection