<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MovieController extends Controller
{
    protected $gallery;
    public function __construct()
    {
        $this->gallery = app()->make(Gallery::class);
    }

    /**
     * 一覧
     *
     */
    public function index()
    {
        $lists = $this->gallery::where('type', 'video')->get();
        return view('admin.movie.list.index', compact(['lists']));
    }

    /**
     * 詳細
     * @param $gallery_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function show($gallery_id)
    {
        $row = $this->gallery::find($gallery_id);

        if (!$row) {
            return redirect()->route('admin.movie');
        }

        return view('admin.movie.detail.index', compact(['row']));
    }

    /**
     * @param $gallery_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($gallery_id)
    {
        $movie = Gallery::find($gallery_id);
        if (!$movie) {
            return back()->with(['type' => 'error', 'message' => '動画を削除できませんでした。']);
        }
        $movie->delete();

        return back()->with(['type' => 'success', 'message' => '動画を削除しました。']);
    }

//    /**
//     * 追加画面
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
//     */
//    public function create()
//    {
//        $subtitle = '追加';
//        return view('admin.movie.create.index', compact(['subtitle']));
//    }

//    /**
//     * 追加処理
//     * @param  GalleryRequest  $request
//     * @return \Illuminate\Http\RedirectResponse
//     */
//    public function store(GalleryRequest $request)
//    {
//        $result = $this->gallery_service->create($request);
//
//        return redirect()->route('admin.movie')->with(
//            [
//                'type' => $result ? 'success' : 'error',
//                'message' => $result ? '動画を登録しました。' : '動画を登録できませんでした。'
//            ]
//        );
//    }

//    public function edit($gallery_id)
//    {
//        $subtitle = '編集';
//        $row = $this->gallery::find($gallery_id);
//
//        if (!$row) {
//            return redirect()->route('admin.movie');
//        }
//        return view('admin.movie.create.index', compact(['subtitle', 'row']));
//    }
//
//    public function update(GalleryRequest $request)
//    {
//        $row = $this->gallery::find($request->gallery_id);
//
//        if (!$row) {
//            return redirect()->route('admin.movie');
//        }
//
//        $result = $this->gallery_service->update($request);
//
//        return redirect()->route('admin.movie')->with(
//            [
//                'type' => $result ? 'success' : 'error',
//                'message' => $result ? '動画を編集しました。' : '動画を編集できませんでした。'
//            ]
//        );
//    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function updateFlg(Request $request)
    {
        $post = $request->all();

        $gallery = Gallery::find($post['gallery_id']);
        if ($gallery) {
            $gallery->up_flg = $post['up_flg'];
            $gallery->save();

            return response('success', 200);
        } else {
            return response('error', 500);
        }
    }
}