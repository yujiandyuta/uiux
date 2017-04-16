@extends('layouts.app')

@section('head')
	@parent
	<style>
		.posted_image{
			max-height: 300px;
			max-width: 300px;
		}
	</style>
@endsection


@section('content')
	<div class="col mx-3">
		@if(isset($fileName))
			<div class = "posted_image">
				<img src="{{ asset(Config::get('const.TEMPORARY_IMAGE_FILE_DIRECTORY') . $fileName) }}" alt="" class="img-responsive">
			</div>
		@endif
		<p>タイトル：{{ $title }}</p>
		<p>概要：{{ $description }}</p>
		<p>タグ：
			@foreach($selectedTags as $tag)
		 		<span class="badge badge-pill badge-default">{{ $tag }}</span>
		    @endforeach
		</p>
		@if($url)
			<p>URL：{{$url}}</p>
		@endif
		<p>Good or Bad：{{$good_or_bad}}</p>

		<form class="form-horizontal" role="form" method="POST" action="{{ url('review') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="title" value="{{ $title }}">
			<input type="hidden" name="description" value="{{ $description }}">
			@if(isset($fileName))
				<input type="hidden" name="fileName" value = "{{ $fileName }}">
			@endif
			@if($url)
				<input type="hidden" name="url" value = "{{ $url }}">
			@endif
			<input type="hidden" name="good_or_bad" value = "{{ $good_or_bad }}">
			<input type="hidden" name="tag" value="{{$tag}}">
			@foreach($selectedTags as $tag)
				<input type="hidden" name="tags[]" value="{{ $tag }}">
		    @endforeach
			<button type="submit" class="btn btn-primary">投稿</button>
		</form>
	</div>
@endsection
