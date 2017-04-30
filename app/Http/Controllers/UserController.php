<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Review;
use App\User;
use Auth;
use App\Libs\CropAvatar;
use App\SocialProvider;

class UserController extends Controller
{

  public function __construct(){
      $this->middleware('auth');
  }


  public function show($name) {
    $user = Auth::user();

    // 引数のidが認証ユーザではない場合、
    // 引数のidのユーザを$userに格納する。
    if($name != $user->name) {
      $user = User::where('name', $name)->first();
    }

    $reviews = Review::latest('created_at')->where('user_id', $user->id)->paginate(\Config::get('const.NUMBER_OF_REVIEWS_PER_PAGE'));
    // $reviews = Review::where('user_id', $user->id)->get();

    return view('user.show', compact('user', 'reviews'));
  }


  public function edit() {
    $user = Auth::user();

    return view('user.edit');
  }


  public function store(\App\Http\Requests\UserEditRequest $request) {
    $user = Auth::user();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $str = $request->input('biography');
    $str = trim($str); // 両サイドのスペースを消す
    $str = preg_replace('/[\n\r\t]/', ' ', $str); // 改行、タブをスペースへ
    $str = preg_replace('/\s(?=\s)/', ' ', $str); // 複数スペースを一つへ
    $user->biography = $str;
    $user->avatar_image_path = $request->input('avatar_image_path');
    $user->save();

    return redirect('/settings/edit')->with('flash_message', '保存しました。');
  }


  public function crop(Request $request) {
    $crop = new CropAvatar(
      Input::has('avatar_src') ? $request->input('avatar_src') : null,
      Input::has('avatar_data') ? $request->input('avatar_data') : null,
      Input::hasFile('avatar_file') ? $_FILES['avatar_file'] : null
    );

    $response = array(
      'state'  => 200,
      'message' => $crop->getMsg(),
      'result' => $crop->getResult(), // ドメイン付きファイルパス
      'avatarImagePath' => $crop->getAvatarImagePath() // ドメイン無しファイルパス
    );

    return response()->json($response);
  }

  // フォローしているユーザの一覧を表示する
  public function showFollowing($name) {
    $user = User::where('name', $name)->first();

    $following = $user->getFollowing();

    return view('user.showfollow', compact('user', 'following'));
  }

  // フォロワーの一覧を表示する
  public function showFollowers($name) {
    $user = User::where('name', $name)->first();

    $followers = $user->getFollowers();
    return view('user.showfollow', compact('user', 'followers'));
  }

  // ソーシャル連携画面を表示する
  public function showLinkSocial() {
    $user = Auth::user();
    $socials = SocialProvider::where('user_id', $user->id)->pluck('social');

    return view('user.linkSocial', compact('socials'));
  }

  // ソーシャル連携を解除するイベント
  public function unlinkSocial($provider) {
    $social = SocialProvider::where('user_id', Auth::user()->id)->where('social', $provider)->delete();
    return redirect('/settings/link');

  }

  // フォローボタンのイベント。Ajax。
  public function follow(Request $request) {
    $name = $request->name;
    $user = User::where('name', $name)->first();

    if($user->isFollowed()) {
      // すでにフォローされている場合、フォローを解除
      $user->resetFollow();
    } else {
      // フォローされていなかった場合、フォローする
      $user->setFollow();
    }

    return response()->json([
        'isFollow' => $user->isFollowed(),
        'followerCount' => $user->getFollowerCount()
    ]);
  }

  // ユーザが確認メールのURLにアクセスした時に実行されるアクション
  public function getConfirm($token) {
      $user = User::where('confirmation_token', '=', $token)->first();
      if (!$user) {
          \Session::flash('flash_message', '無効なトークンです。');
          return redirect('/');
      }

      $user->confirm();
      $user->save();

      \Session::flash('flash_message', '新しいメールアドレス '. $user->email .' を確認しました');
      return redirect('/');
  }

}
