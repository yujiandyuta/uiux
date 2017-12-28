<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111357514-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-111357514-1');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('images/app_images/yyuxlogo_black.ico') }}">
    <title>{{ $title or config('app.name') }}</title>
    <meta name="description" content="{{ Config::get('const.SITE_DESCRIPTION') }}"/>
    <meta name="keywords" content="{{ Config::get('const.SITE_KEYWORD') }}"/>

    <!-- ogp -->
    <meta property="og:title" content="{{ $title or config('app.name') }}"/>
    <meta property="og:type" content="{{ $ogType or 'website' }}"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:image" content="{{ isset($ogImage) ? asset($ogImage) : asset(Config::get('const.APP_IMAGES_DIRECTORY') . 'yyuxlogo_white.png') }}"/>
    <meta property="og:site_name" content="{{ config('app.name') }}}"/>
    <meta property="og:description" content="{{ Config::get('const.SITE_DESCRIPTION') }}"/>

    <meta name="twitter:card" content="{{ Config::get('const.TWITTER_CARD') }}"/>
    <meta name="twitter:site" content="{{ Config::get('const.TWITTER_ID') }}">

    <!-- Styles -->
    @section('head')
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/bootstrap-social.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="/css/cropper.css">
        <link rel="stylesheet" href="/css/croppermain.css">
        <link rel="stylesheet" href="/css/mystyles.css">
    @show

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(), ]) !!}
    </script>
</head>

<body class="yy-body yy-bg-body d-flex flex-column">

    {{-- consoleでvueのエラーがでるので以下を残す。使途不明。 --}}
    <div id="app"></div>

    <!-- ナビゲーションバー -->
    <header>
    @section('navigationBar')

        <nav class="navbar navbar-expand-md navbar-dark fixed-top yy-bg-midnightblue">
            <div class="container">
                <a class="navbar-brand text-white" href="/">
                    <img src="{{ asset('images/app_images/yyuxlogo_white.png') }}" style="height: 1.8rem;" class="mr-2" />
                    yyUX
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="mr-auto"></div>
                    <div class="btn-group">
                    <!-- bootstrapのspacingが効かない？ -->
                    <a data-toggle="dropdown" href="#" style="margin:auto 5px;">
                        <i class="fa fa-globe fa-2x yy-notifications-icon" aria-hidden="true"></i>
                        @if(Auth::user())
                        <span class="badge badge-danger yy-unreadnotification-count" style="position: relative;left: -10px; @if(count(Auth::user()->unreadNotifications) == 0) visibility:hidden @endif">
                            {{ count(Auth::user()->unreadNotifications) }}
                        </span>
                        @endif
                    </a>
                        <div class="dropdown-menu yy-notifications">
                            @if(Auth::check())
                                <div class="ml-3">
                                    お知らせ一覧
                                </div>
                                <div class="dropdown-divider"></div>
                                @forelse(Auth::user()->notifications->take(10) as $key => $notification)
                                    <div>
                                        <a class="dropdown-item" href="{{ $notification->data['url'] }}" style="width: 400px;">
                                            <div class="row">
                                                <div class="col-1 pl-0">
                                                    <span class="yy-avatar-thumbnail-img yy-vertical-align-middle" style="background-image: url({{ asset(App\User::find($notification->notifier_id)->avatar_image_path) }})"></span>
                                                </div>
                                                @if(!isset($notification->read_at))
                                                    <div class="col-1 yy-unreadnotification-mark">
                                                        ●
                                                    </div>
                                                @endif
                                                <div class="col">
                                                    <span style="white-space: normal;">{{ $notification->data['message'] }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @if(count(Auth::user()->notifications) != $key + 1)
                                        <div class="dropdown-divider"></div>
                                    @endif
                                @empty
                                    通知はまだありません
                                @endforelse
                            @else
                                <a href="/login">yyuiuxに登録しよう！</a>
                            @endif
                        </div>
                    </div>


                    <form class="form-inline my-0" method="GET" action="{{ url('/timeline') }}">
                        <input class="form-control mr-2" type="text" placeholder="Search" value="{{ $searchWords or '' }}" name="searchWords" required>
                        <button class="yy-pointer btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <!-- ログイン / ユーザネーム -->
                    <ul class="navbar-nav form-inline mx-2">
                    @if (Auth::guest())
                        <li><a class="text-white" href="{{ url('/login') }}">ログイン</a></li>
                        <li><span class="text-white" class="mx-2">/</span></li>
                        <li><a class="text-white" href="{{ url('/register') }}">新規登録</a></li>
                    @else
                        <span class="yy-avatar-thumbnail-img mx-2" style="background-image: url({{ asset(Auth::user()->avatar_image_path) }})"></span>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ action('UserController@show', Auth::user()->name) }}">
                                        マイページ
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                    </ul>
                </div>
            </div>
        </nav>
    @show
    </header>

    <!-- ナビゲーションバー以下 -->
    <main class="mb-auto">
        <div id="crop-avatar">
            <div class="container my-3">
                <div class="row justify-content-center">
                            <!-- 左サイドバー -->
                            @section('leftSideBar')

                            @show
                            <!-- 中央メインコンテンツ -->
                            @section('content')
                            @show
                            <!-- 右サイドバー -->
                            @section('rightSideBar')
                                <nav class="col-lg-3 px-0 mx-3">

                                    <div class="yy-outline mb-3">
                                        <div class="yy-bg-test text-white px-3 py-2">
                                            <p class="m-0">
                                                投稿する
                                            </p>
                                        </div>
                                        <div class="px-3 py-2">
                                            <small>
                                                サービス、プロダクトのUXについてレビュー評価しよう！
                                            </small>
                                            <a href="{{ url('/post/create') }}" class="mt-2 btn btn-outline-primary d-block">UXレビューする</a>
                                        </div>
                                    </div>

                                    <div class="yy-outline mb-3">
                                        <div class="yy-bg-test text-white px-3 py-2">
                                            <p class="m-0">
                                                依頼する
                                            </p>
                                        </div>
                                        <div class="px-3 py-2">
                                            <small>
                                                自分のサービス、プロダクトのレビューを依頼しよう！
                                            </small>
                                            <a href="{{ url('/request/create') }}" class="mt-2 btn btn-outline-primary d-block">UXレビュー依頼する</a>
                                        </div>
                                    </div>

                                    <ul class="nav nav-pills flex-column mb-3">
                                        <li class="nav-item yy-outline-bottom">
                                            <p class="nav-link yy-bg-test text-white my-0" >トップタグ</p>
                                        </li>
                                        @foreach($summaryTags as $tag)
                                        <li class="nav-item yy-outline-bottom d-flex justify-content-between px-3 py-2">
                                            <a class="d-inline-block nav-link yy-bg-sidebar p-0" href="/timeline?tagId={{ $tag->tag_id }}">
                                                <span class="badge badge-pill badge-secondary">{{ $tag->tag_name }}</span>
                                            </a>
                                            <p class="d-inline-block m-0">{{ $tag->count }}<small>タグ</small></p>
                                        </li>
                                      @endforeach
                                    </ul>

                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item yy-outline-bottom">
                                            <p class="nav-link yy-bg-test text-white my-0" >
                                                今月のランキング
                                                <a class="text-white yy-fontsize-09" href="/ranking">
                                                    (もっと見る)
                                                </a>
                                            </p>
                                        </li>
                                        @foreach($summaryScores as $score)
                                            <li class="nav-item yy-outline-bottom d-flex justify-content-between px-3 py-2">
                                                <a class="d-inline-block nav-link yy-bg-sidebar p-0" href="/{{ $score->user_name }}">
                                                    <span class="yy-avatar-thumbnail-img" style="background-image: url({{ asset($score->avatar_image_path) }})"></span>
                                                    <small>{{ $score->user_name }}</small>
                                                </a>
                                                <p class="d-inline-block m-0"><small>スコア</small>{{ $score->score }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            @show
                </div>
            </div>
            @include('subs.cropper')
        </div>

    </main>
    <!-- フッター -->
    <footer class="footer bg-dark">
    @section('footer')
        <div class="container">
            <div class="row justify-content-center bg-dark">
                <div class="col-12 m-0 p-0">
                    <div class="row mx-0 p-0 mt-3">
                        <div class="col-md-6 py-2 px-3">
                            <ul class="text-white">
                                <li>
                                    <a class="text-white" href="/legal">利用規約</a>
                                </li>
                                <li>
                                    <a class="text-white" href="/privacy">プライバシーボリシー</a>
                                </li>
                                <li>
                                    よくある質問
                                </li>
                                <li>
                                    <a class="text-white" href="/contact">お問い合わせ</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 py-2 px-3 text-white d-flex align-items-center">
                            <div class="d-block">
                                <h1 class="pb-2">
                                    <img src="{{ asset('images/app_images/yyuxlogo_white.png') }}" style="height: 3.5rem;" class="mr-2" />
                                    yyUX
                                </h1>
                                <p class="d-inline">
                                    <a class="text-white" href="/about">yyUXについて</a>
                                </p>
                                <span class="px-1">|</span>
                                <p class="d-inline">
                                    <a class="text-white" href="http://yyux.hatenablog.com/" target="_blank">
                                        公式ブログ
                                    </a>
                                </p>
                                <span class="px-1">|</span>
                                <p class="d-inline">
                                    <a class="text-white" href="https://twitter.com/info_yyUX?lang=ja" target="_blank">
                                        <span class="fa fa-twitter"></span>@info_yyUX
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 py-2 px-3">
                    <p class="m-0 text-white text-center">
                        Copyright© 2017 yyUX All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    @show
    </footer>
    <!-- Scripts -->
    @section('foot')
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script> --}}
        <script src="/js/app.js"></script>
        <script src="/js/myscripts.js"></script>
        <script>
            @if(Auth::user())
                // 通知アイコンをクリックで通知テーブルに既読をつける
                $('.yy-notifications-icon').on('click',function(){
                    var userId = {{Auth::user()->id}};
                    $.ajax({
                        url: "/notification/read",
                        type:'POST',
                        dataType: 'json',
                        data : {
                            userId : userId
                        },
                        success: function(data) {
                            $('.yy-unreadnotification-count').css('visibility', 'hidden');
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){

                        }
                    });
                });
            @endif
        </script>
  @show
</body>
</html>
