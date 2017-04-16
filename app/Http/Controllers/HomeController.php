<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\Review_Agree;
use App\Review_Tag;
use App\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query;

        if(isset($request->feed) && $request->feed != 'ALL') {
            $query = Review::where('good_or_bad', \Config::get('enum.good_or_bad')[$request->feed])->orderBy('created_at', 'desc');
        }else{
            $query = Review::latest('created_at');
        }

        //検索条件にタグを加える
        $tagId = $request->input('tagId');

        $selectedTag;

        if(!empty($tagId)){
            $selectedTag = Tag::select('name')->where('id', $tagId)->first();
            $query = $this->setTags($query, $tagId);
        }

        //検索条件に検索ワードを加える
        $searchWords = $request->input('searchWords');
        $reviews = $this->setSearchWords($query, $searchWords)->paginate(\Config::get('const.NUMBER_OF_REVIEWS_PER_PAGE'));

        $reviews->setPath('?searchWords=' . $searchWords . '&tagId='. $tagId);

        return view('home.index', compact('reviews', 'searchWords', 'tagId', 'selectedTag'));

    }

    private function setSearchWords($query, $searchWords) {
        if(!empty($searchWords)){
            //全角スペースを半角スペースに変換し半角スペースでpreg_split
            $searchWordsArray =preg_split('/[\s]+/',mb_convert_kana($searchWords, 's'));

            $query = $query->Where(function ($q) use(&$searchWordsArray, &$tagQuery) {
                $tagQuery = Review_Tag::select('review_tag.review_id')->join('tags', 'review_tag.tag_id', 'tags.id');
                foreach($searchWordsArray as $searchWord){
                    $q->orwhere('title', 'like', '%' . $searchWord . '%')->orWhere('description', 'like', '%' . $searchWord . '%');
                    $tagQuery = $tagQuery->where('tags.name', 'like', '%' . $searchWord . '%');
                }
                $q->orWhereIn('id', $tagQuery->get());
            });

        }

        return $query;
    }

    private function setTags($query, $tagId) {
        if(!empty($tagId)){
            $reviewIds = Review_Tag::select('review_tag.review_id')->join('tags', 'review_tag.tag_id', 'tags.id')->where('tags.id', $tagId)->get();
            $query = $query->Where(function ($q) use(&$reviewIds){
                $q->orWhereIn('id', $reviewIds);
            });
        }
        return $query;
    }

    public function tagSearch($tagId) {
        $ids = Review_Tag::select('review_tag.review_id')->join('tags', 'review_tag.tag_id', 'tags.id')->where('tags.id', $tagId)->get();

        $reviews = Review::whereIn('id',$ids)->paginate(\Config::get('const.NUMBER_OF_REVIEWS_PER_PAGE'));

        return view('home.index', compact('reviews', 'tagId'));
    }

    public function showAbout()
    {
        return view('home.about');

    }
}
