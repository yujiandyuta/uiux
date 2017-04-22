@extends('layouts.app')

@section('head')
  @parent
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
      img {
        width: auto;
        height: auto;
        max-width: 120px;
        max-height: 150px;
      }
      .clicked{
        /*bootstrapのdisabledとほぼ同じだけどカーソルにnot-allowedをつけたくないのでここに書きました*/
        filter: alpha(opacity=65);
        -webkit-box-shadow: none;
        box-shadow: none;
        opacity: .65;
      }
  </style>
@endsection

@section('content')
  <div class="col mx-3">
    @if (session('flash_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ session('flash_message') }}
      </div>
    @endif
    @if($review->image_name)
     <img src="{{ asset(Config::get('const.IMAGE_FILE_DIRECTORY') . $review->image_name) }}" alt="">
    @endif
    <h4>レビュー依頼タイトル：{{ $review->title }}</h4>
    <p>依頼詳細：{{ $review->description }}</p>
    <span>{{\App\Libs\Util::agoDateWriting($review->created_at)}}</span>
    
    @foreach($review->reviewTag as $reviewTag)
      <span class="badge badge-pill badge-default">{{ $reviewTag->tag->name }}</span>
    @endforeach

    <div class="comments">
      <h5 class="comment-header">コメント：{{$review->commentsCount()->count()}}件</h5>
      @foreach($review->comments as $reviewComment)
        <div class="comment">
          <div>
            <p>{{$reviewComment->comment}}</p>
          </div>
          <div class="commented-user">
            @if($reviewComment->user->id == Auth::user()->id)
              <form action="{{ action('ReviewCommentController@destroy') }}" method="post" accept-charset="utf-8">
                {{ csrf_field() }}
                <input type="hidden" name="commentId" value="{{$reviewComment->id}}">
                <input type="hidden" name="reviewId" value="{{$review->id}}">
                <input class="btn btn-danger btn-sm" type="submit" name="deleteButton" value="削除">
                <span>投稿者：{{$reviewComment->user->name}}</span>
                <span>投稿時間：{{\App\Libs\Util::agoDateWriting($reviewComment->created_at)}}</span>
              </form>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    <p>このレビュー依頼にコメントをする</p>
    @if ($errors->has('comment'))
      <span class="help-block">
        <strong>{{ $errors->first('comment') }}</strong>
      </span>
    @endif
    <form action="{{ action('ReviewCommentController@store') }}" method="post">
      {{ csrf_field() }}
      <textarea class="comment-textarea" name="comment"></textarea>
      <input type="hidden" name="reviewId" value="{{$review->id}}">
      <input type="hidden" name="userId" value="{{Auth::user()->id}}">
      <input class="btn btn-primary" type="submit" name="commentSubmit" value="コメントする">
    </form>
  </div>
@endsection

@section('foot')
  @parent
  <script>
  // ボタン連打対策
  $(function () {
    $('form').submit(function () {
      $(this).find(':submit').prop('disabled', true);
    });
  });

  // 賛成・反対のボタン押下時イベント。Ajax。
  $('.agree').on('click',function(){
    var userID = {{Auth::user()->id}};
    var reviewID = {{$review->id}};
    var agree = $(this).val();
    $.ajax({
      url: "/review/agree",
      type:'POST',
      dataType: 'json',
      data : {
        user_id : userID,
        review_id : reviewID,
        agree : agree
        },
      success: function(data) {
        $('.agree').toggleClass('clicked');
        if(data.isDeleted){
          $('#agree').text('賛成');
          $('#disagree').text('反対');
        }else if(data.isAgree == {{Config::get('enum.agree.AGREE')}}){
          $('#agree').text('賛成済');
        }else if(data.isAgree == {{Config::get('enum.agree.DISAGREE')}}){
          $('#disagree').text('反対済');
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown){
        alert('賛成・反対の送信に失敗しました');
      }
    });
  });
  </script>
@endsection