<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Review;
use App\User;
use Auth;
use App\Libs\CropAvatar;

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
    $reviews = Review::where('user_id', $user->id)->get();

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
    $user->biography = $request->input('biography');
    $user->avatar_image_path = $request->input('avatar_image_path');
    $user->save();

    return redirect('/settings/edit')->with('flash_message', '保存しました。');
  }


  public function crop(Request $request){
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

    // echo json_encode($response);
  }

}
