@extends('layouts.app')



@section('content')

<div class="container">
	<div class="card">
		<div class="card-body">
			    <h5 class="card-title text-center font-weight-bold">Add Post</h5>

				<form enctype="multipart/form-data" action="{{route('post.store')}}" method="post">
					@csrf
				   <div class="form-group">
				   	  <label for="img">image</label>
				   	  <input type="file" name="img" class="form-control" id="img" required>
				   	 @if($errors->has('img')) 
				   	  <p class="text-danger"> - {{$errors->first('img')}} - </p>
				   	 @endif 
				   </div>

				   <div class="form-group">
				   	  <label for="caption">Caption</label>
				   	  <textarea id="caption" name="caption" class="form-control" rows="5"></textarea>
				   	 @if($errors->has('caption')) 
				   	  <p class="text-danger"> - {{$errors->first('caption')}} - </p>
				   	 @endif 
				   </div>
                   
                   <div class="form-group text-center">
				      <input type="submit" value="Add New Post" class="btn btn-primary ">
				   </div>   

				</form>
	    </div>
	</div>
</div>


@endsection