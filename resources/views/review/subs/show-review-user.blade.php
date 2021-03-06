<div class="row mx-0">
  <div class="col p-0">
      @if(isset($review->user->avatar_image_path))
          <span class="yy-avatar-thumbnail-img yy-vertical-align-middle" style="background-image: url({{ asset($review->user->avatar_image_path) }})"></span>
      @else
          <span class="yy-avatar-thumbnail-img yy-vertical-align-middle" style="background-image: url({{ asset(Config::get('const.APP_IMAGES_DIRECTORY') . 'yyuxlogo_black.png') }})"></span>
      @endif

    @if(isset($review->user))
      <a class="yy-fontsize-09" href="{{ action('UserController@show', ['username' => isset($review->user->name) ? $review->user->name : '退会済みユーザー']) }}" title="">{{ $review->user->name }}</a>
    @else
      <span class ="yy-fontsize-09">{{ '退会済みユーザー' }}</span>
    @endif
    @foreach($review->reviewTag as $reviewTag)
      <a href="/timeline?tagId={{ $reviewTag->tag->id }}"><span class="badge badge-pill badge-secondary">{{ $reviewTag->tag->name }}</span></a>
    @endforeach
  </div>
  <div class="col-3 p-0 text-right">
    <p class="text-right m-0 yy-fontsize-09">{{\App\Libs\Util::agoDateWriting($review->created_at)}}</p>
  </div>
</div>
