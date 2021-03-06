<!DOCTYPE html>
<html lang="ja">
<head>
    @if(env("APP_ENV") == 'production')
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
    @endif

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

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
    <meta property="og:image" content="{{ isset($ogImage) ? asset($ogImage) : asset(Config::get('const.APP_IMAGES_DIRECTORY') . 'yyuxlogo_black.ico') }}"/>
    <meta property="og:site_name" content="{{ config('app.name') }}}"/>
    <meta property="og:description" content="{{ Config::get('const.SITE_DESCRIPTION') }}"/>

    <meta name="twitter:card" content="{{ Config::get('const.TWITTER_CARD') }}"/>
    <meta name="twitter:site" content="{{ Config::get('const.TWITTER_ID') }}">

    <!-- Styles -->
    @section('head')
        @loadLocalCSS(/css/app.css)
        @loadLocalCSS(/css/bootstrap-social.css)
        @loadLocalCSS(/css/cropper.css)
        @loadLocalCSS(/css/croppermain.css)
        @loadLocalCSS(/css/mystyles.css)
    @show

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(), ]) !!}
    </script>
    @loadLocalJS(/js/fontawesome-all.min.js)
</head>

<body class="yy-body yy-bg-body d-flex flex-column">

    {{-- consoleでvueのエラーがでるので以下を残す。使途不明。 --}}
    <div id="app"></div>

    <!-- ナビゲーションバー -->
    <header>
    @section('navigationBar')

        <nav class="navbar navbar-expand-md navbar-dark fixed-top yy-bg-midnightblue">
            <div class="container d-flex">
                <a class="navbar-brand text-white mr-auto" href="/">
                    <img src="{{ asset(Config::get('const.APP_IMAGES_DIRECTORY') . '/yyuxlogo_white.png') }}" style="height: 1.8rem;" class="mr-2" />
                    yyUX
                </a>
                {{-- <div class="ml-auto"></div> --}}

                <div class="d-flex align-items-center justify-content-end">

                    {{-- ゲストの場合、レビュー投稿機能は表示しない --}}
                    @if (!Auth::guest())
                        @include('layouts.subs.edit')
                    @endif

                    {{-- ゲストの場合でも、検索機能は表示する --}}
                    @include('layouts.subs.search')

                    {{-- ゲストの場合、通知ボタンは表示しない --}}
                    @if (!Auth::guest())
                        @include('layouts.subs.notifications')
                    @endif

                    @include('layouts.subs.user-etc')
                </div>

            </div>
        </nav>
    @show
    </header>

    <!-- ナビゲーションバー以下 -->
    <main class="mb-auto">
        <div id="crop-avatar">
            <div class="container my-3 px-0">
                <div class="row justify-content-center mx-0">
                    <!-- 左サイドバー -->
                    @section('leftSideBar')

                    @show
                    <!-- 中央メインコンテンツ -->
                    @section('content')
                    @show
                    <!-- 右サイドバー -->
                    @section('rightSideBar')
                        <nav class="col-12 col-lg-3 px-3">

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
                                    <p class="nav-link yy-bg-test text-white my-0" >よく読まれているレビュー</p>
                                </li>
                                <ol class="pl-4">
                                    @foreach($pvRankings as $pvRanking)
                                        <li>
                                            <a href="/post/{{ $pvRanking->review->id }}"><span class="pv-ranking-title">{{ $pvRanking->review->title }}</span></a>
                                        </li>
                                    @endforeach
                                </ol>
                          </ul>
                            <style type="text/css" media="screen">
                                .pv-ranking-title{
                                    font-size: 75%;
                                }
                            </style>

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
                                            @if(isset($score->avatar_image_path))
                                                <span class="yy-avatar-thumbnail-img yy-vertical-align-middle" style="background-image: url({{ asset($score->avatar_image_path) }})"></span>
                                            @else
                                                <span class="yy-avatar-thumbnail-img yy-vertical-align-middle" style="background-image: url({{ asset(Config::get('const.APP_IMAGES_DIRECTORY') . 'yyuxlogo_black.png') }})"></span>
                                            @endif
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
                                        <i class="fab fa-twitter"></i>@info_yyUX
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 py-2 px-3">
                    <p class="m-0 text-white text-center">
                        Copyright© 2017-2018 yyUX
                    </p>
                </div>
            </div>
        </div>
    @show
    </footer>
    <!-- Scripts -->
    @section('foot')
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
        @loadLocalJS(/js/app.js);
        @loadLocalJS(/js/myscripts.js);
        <script>
            @if(Auth::user())
                // 通知アイコンをクリックで通知テーブルに既読をつける
                $('a.yy-notifications-icon').on('click',function(){
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
