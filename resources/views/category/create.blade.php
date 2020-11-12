@extends('layouts.app')
@section('title', 'Create Caregory')
@section('content')
	
	<div class="container">
		<div class="row justify-contect-center">
			<div class="col-md-8">
				<div class="jumbotron">
					<form  action="{{route('catstore')}}" method="POST">
						@csrf  
					  <div class="form-group">
					    <label for="exampleInputTitl">Category Name</label>
					    <input type="text" class="form-control" id="exampleInputTitle1" value="{{old('category_name')}}" name="category_name">
						 @error('category_name')
						    <div class="alert alert-danger">{{ $message }}</div>
						 @enderror
						</div>
					  <button type="submit" class="btn btn-primary">Create Category</button>
					</form>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="jumbotron">
					<table class="table table-hover">
						<thead>
							<th>No</th><th>Name</th><th>Created Date</th><th>Action</th>
						</thead>
						<tbody>
							@foreach($categories as $key=>$category)
								<tr>
								<th>{{++$key}}</th><th>{{$category->name}}</th><th>{{Carbon\Carbon::parse($category->created_at)->format('y-M-d')}}</th>
								<th>
									<a href="#">delete</a>&nbsp;
									<a href="#">edit</a>
								</th>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>						


@endsection