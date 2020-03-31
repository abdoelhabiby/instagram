@extends('layouts.app')


@section('content')

<div class="container">
	<div class="card" style="max-width: 600px; margin:auto;">
		<div class="card-body">
			<div class="card-title text-center">
			<img src="{{asset(auth()->user()->img)}}" style="width: 120px; height: 120px; border-radius: 50%">
				<h2> Edit Profile </h2>
			</div>
			 <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
			 	@csrf
			 	@method('put')
			 	 
			 	 <div class="form-group">
			 	 	<label for="name">Name</label>
			 	 	<input type="text" name="name" id="name" class="form-control" 
			 	 	value="{{ old('name') ?? auth()->user()->name}}">
			 	 	@if($errors->has('name'))
			 	 	 <p class="text-danger">{{$errors->first('name')}}</p>
			 	 	@endif 
			 	 </div>
			     <!-- ---------------------------------------------------------------------- -->			 
			     <div class="form-group">
			 	 	<label for="username">Username</label>
			 	 	<input type="text" name="username" id="username" class="form-control" 
			 	 	value=" {{ old('username') ?? auth()->user()->username}}">
			 	 	@if($errors->has('username'))
			 	 	 <p class="text-danger">{{$errors->first('username')}}</p>
			 	 	@endif 
			 	 </div>
			   <!-- ---------------------------------------------------------------------- -->			 
			     <div class="form-group">
			 	 	<label for="email">E-mail</label>
			 	 	<input type="email" name="email" id="email" class="form-control" value="{{ old('email') ?? auth()->user()->email}}">
			 	 	@if($errors->has('email'))
			 	 	 <p class="text-danger">{{$errors->first('email')}}</p>
			 	 	@endif 
			 	 </div>	
			   <!-- ---------------------------------------------------------------------- -->	

			     <div class="form-group">
			 	 	<label for="img">Image profile</label>
			 	 	<input type="file" name="img" id="img" class="form-control" >
			 	 	@if($errors->has('img'))
			 	 	 <p class="text-danger">{{$errors->first('img')}}</p>
			 	 	@endif 
			 	 </div>	
			   <!-- ---------------------------------------------------------------------- -->			 
		 
			     <div class="form-group">
			 	 	<label for="description">description</label>
			 	 	<textarea name="description" id="description" class="form-control" rows='5'>{{old('description') ?? auth()->user()->description}}
			 	 	</textarea>
			 	 	@if($errors->has('description'))
			 	 	 <p class="text-danger">{{$errors->first('description')}}</p>
			 	 	@endif 
			 	 </div>			 
		  <!-- ---------------------------------------------------------------------- -->			 
			     <div class="form-group">
			 	 	<label for="url">Url</label>
			 	 	<input type="text" name="url" id="url" class="form-control" value="{{ old('url') ?? auth()->user()->url}}">
			 	 	@if($errors->has('url'))
			 	 	 <p class="text-danger">{{$errors->first('url')}}</p>
			 	 	@endif 
			 	 </div>
			 <!-- ---------------------------------------------------------------------- -->

			  <div class="form-group text-center">
			  	 <input type="submit" value="Edit profile" class="btn btn-primary">
			  </div>

	         </form>

		</div>
	</div> 


</div>


@endsection