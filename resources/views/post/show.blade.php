@extends('layouts.app')
@section('title', 'Postdetils')
@section('content')
<div class="container">
		<a href="{{route('create')}}" class="btn btn-primary">Create Posts</a>
		
		<div class="row justify-contect-center">
			<div class="col-md-8">
				<div class="jumbotron">
					<h2>{{$post->title}}</h2>
					@if(isset($post->image))
					<img src="{{asset('/storage/uploads/'. $post->image)}}" class="img-thumbnial" style="width: 100%;">
					@endif
					<p>{{$post->description}}</p>

					
					<span>{{$post->category->name}}</span>
				 	

					<span style="margin-left: 30px;">{{Carbon\Carbon::parse($post->created_at)->format('y-M-d')}}</span>
					<h6>{{$post->user->name}}</h6>

				</div>
			</div>
		</div>
		 
	</div>						


@endsection