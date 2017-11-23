@extends('layouts.app')

@section('content')
    <div class="col mx-3">

        @if(isset($review))
          <a href="/review/delete/{{ $review->id }}" onclick="return deleteConfirm();">このレビューを削除</a>｜
        @endif

        <h1 class="mb-4">UXレビューを依頼する</h1>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/request/store') }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
            <input type="hidden" name="review_id" value="{{isset($review) ? $review->id : ''}}">

            <div class="form-group row">
              <label class="col-2 col-form-label">タイトル<span class="yy-post-annotation"> ※必須</span></label>
              <input id="title" type="text" class="col-10 form-control" name="title" value="{{ old('title', isset($review->title) ? $review->title : '') }}" required autofocus>
              @if ($errors->has('title'))
                  <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group row">
              <label class="col-2 col-form-label">URL</label>
              <input id="url" type="text" class="col-10 form-control" name="url" value="{{ old('url', isset($review->url) ? $review->url : '') }}">
              @if ($errors->has('url'))
                  <span class="help-block">
                      <strong>{{ $errors->first('url') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group row">
              <label class="col-2 col-form-label">タグ</label>
              @include('review.subs.review-tag')
            </div>

            <div class="form-group row">
              <label class="col-12 col-form-label">詳細<span class="yy-post-annotation"> ※必須</span></label>
              <textarea id="description" type="text" class="col form-control" name="description" rows="8">{{ old('description', isset($review->description) ? $review->description : '') }}</textarea>
              @if ($errors->has('description'))
                  <span class="help-block">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
              @endif
            </div>

            <label class="col-12 col-form-label">レビュー依頼画像</label>
            @include('review.subs.review-image')

            <div class="text-center">
              <button type="submit" class="btn btn-primary">投稿</button>
            </div>
        </form>

    </div>
@endsection

@section('foot')
  @parent

  @include('review.js.autocomplete-tag-form')
  @include('review.js.enter-tag-form')
  @include('review.js.remove-tag')
  @include('review.js.remove-image')
  @include('review.js.input-tag')
  @include('review.js.delete-review-confirm')
  <script src="/js/cropper.js"></script>
  <script src="/js/reviewcroppermain.js"></script>

@endsection
