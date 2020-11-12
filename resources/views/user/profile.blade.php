@extends('layouts.app')
@section('title', 'Profile')
@section('content')
	
	<div class="container">
		<a href="{{route('create')}}" class="btn btn-primary">Create Posts</a>
		@if(session('success'))
			<div class="alert alert-success">{{session('success')}}</div>
		@endif
		@foreach($posts as $post)
		<div class="row justify-contect-center">
			<div class="col-md-8">
				<div class="jumbotron">
					<h2>{{$post->title}}</h2>
					@if(isset($post->image))
					<img src="{{asset('/storage/uploads/'. $post->image)}}" class="img-thumbnial" style="width: 100%;">
					@endif
					<p>{{str_limit($post->description, $limit=255, $end='.....')}}</p>

					
					<span style="margin-right: 30px;">
					   {{$post->category->name}}
					
					</span>
					

					<span style="margin-left: 30px;">{{Carbon\Carbon::parse($post->created_at)->format('y-M-d')}}</span>
					<h6>{{$post->user->name}}</h6>

					<a href="{{route('show', $post->id)}}" style="margin-right: 30px;">view</a><a href="{{route('edit', $post->id)}}" style="margin-right: 30px;">Edit</a>
					<a href="{{route('destroy', $post->id)}}" onclick="return confirm('Are you sure?')">delete</a>

				</div>
			</div>
		</div>
		@endforeach
	</div>						


@endsection