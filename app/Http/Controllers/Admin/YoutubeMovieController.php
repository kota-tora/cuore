<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests\GalleryRequest;
use App\Models\YoutubeMovie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class YoutubeMovieController extends Controller
{
    protected $youtube_movie;
    public function __construct()
    {
        $this->youtube_movie = app()->make(YoutubeMovie::class);
    }

    /**
     * 一覧
     *
     */
    public function index()
    {
        $lists = $this->youtube_movie::orderBy('youtube_movie_id', 'desc')->get();
        return view('admin.youtube_movie.list.index', compact(['lists']));
    }

    /**
     * 詳細
     * @param $youtube_movie_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function show($youtube_movie_id)
    {
        $row = $this->youtube_movie::find($youtube_movie_id);

        if (!$row) {
            return redirect()->route('admin.youtube_movie');
        }

        return view('admin.youtube_movie.detail.index', compact(['row']));
    }

    /**
     * @param $youtube_movie_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($youtube_movie_id)
    {
        $movie = YoutubeMovie::find($youtube_movie_id);
        if (!$movie) {
            return back()->with(['type' => 'error', 'message' => '動画を削除できませんでした。']);
        }
        $movie->delete();

        return back()->with(['type' => 'success', 'message' => '動画を削除しました。']);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function updateFlg(Request $request)
    {
        $post = $request->all();

        $movie = YoutubeMovie::find($post['youtube_movie_id']);
        if ($movie) {
            $movie->up_flg = $post['up_flg'];
            $movie->save();

            return response('success', 200);
        } else {
            return response('error', 500);
        }
    }
}