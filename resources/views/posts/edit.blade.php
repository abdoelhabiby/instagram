@extends('layouts.app')



@section('content')


 <div class="container"  style="max-width: 400px; margin: auto;">
	<div class="card">
		<div class="card-body">

                

			    <h5 class="card-title text-center font-weight-bold">Edit Post</h5>
                      <div class="text-center mb-2">
			    		<img src="{{asset($post->img)}}" style="height: 300px; width: 300px">
                      </div> 
			    	<div class="">
						<form  action="{{route('post.update',$post->id)}}" method="post">
							@csrf
							@method('put')
			

						   <div class="form-group">
						   	  <label for="caption">Caption</label>
						   	  <textarea id="caption" name="caption" class="form-control" rows="4" style="resize: none;">{{$post->caption}}
						   	  </textarea>
						   	 @if($errors->has('caption')) 
						   	  <p class="text-danger"> - {{$errors->first('caption')}} - </p>
						   	 @endif 
						   </div>
		                   
		                   <div class="form-group text-center">
						      <input type="submit" value="Edit Post" class="btn btn-primary ">
						   </div>   

						</form>
			    	</div>


	    </div>
	</div>
</div>




@endsection