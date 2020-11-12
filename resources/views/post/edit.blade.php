@extends('layouts.app')
@section('title', 'Edit')
@section('content')
	
	<div class="container">
		@if(session('success'))
 			<div class="alert alert-success">{{session('success')}}</div> 
 		@endif
		<div class="row justify-contect-center">
			<div class="col-md-8">
				<div class="jumbotron">
					<form method="post" action="{{route('update', $post->id)}}" enctype="multipart/form-data">
						@csrf
					  <div class="form-group">
					    <label for="exampleInputTitl">Title</label>
					    <input type="text" class="form-control" id="exampleInputTitle1" aria-describedby="titleHelp" name="title" value="{{$post->title}}">
					  </div>
						 @error('title')
						    <div class="alert alert-danger">{{ $message }}</div>
						@enderror
					  <div class="form-group">
					    <label for="exampleInputDescription1">Description</label>
					    <textarea name="description" id="exampleInputDescription1" rows="10" class="form-control">{{$post->description}}</textarea>
					  </div>
					  @error('description')
						    <div class="alert alert-danger">{{ $message }}</div>
						@enderror
					  <div class="form-group form-check">
					    <label for="exampleCategory1">Category</label>
					    <select name="category" class="form-control" value="{{$post->category->name}}">
					    	@foreach($categories as $category)
					    	<option value="{{$category->id}}" {{($category->id==$post->category->id)?'selected':null}}>
					    		{{$category->name}}
					    	</option>
					    	@endforeach
					    </select>
					  </div>
					  @error('category')
						    <div class="alert alert-danger">{{ $message }}</div>
						@enderror


						<div class="form-group">
					    <label for="exampleInputTitl">Upload Photo</label>
					    <input type="file" class="form-control" id="exampleInputImage1" aria-describedby="imageHelp" name="image">
					  
						 @error('image')
						    <div class="alert alert-danger">{{$message}}</div>
						@enderror
						</div>
					  <button type="submit" class="btn btn-primary">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>						


@endsection