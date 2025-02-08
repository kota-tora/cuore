<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GalleryRequest;
use App\Http\Services\GalleryService;
use App\Models\Gallery;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GalleryController extends Controller
{
    protected $gallery;
    protected $gallery_service;
    public function __construct(GalleryService $gallery_service)
    {
        $this->gallery = app()->make(Gallery::class);
        $this->gallery_service = $gallery_service;
    }

    /**
     * 一覧
     *
     */
    public function index()
    {
        $lists = $this->gallery::where('type', 'image')->orderBy('photo_date', 'desc')->get();
        return view('admin.gallery.list.index', compact(['lists']));
    }

    /**
     * 追加画面
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $subtitle = '追加';
        return view('admin.gallery.create.index', compact(['subtitle']));
    }

    /**
     * 追加処理
     * @param  GalleryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GalleryRequest $request)
    {
        $result = $this->gallery_service->create($request);

        return redirect()->route('admin.gallery')->with(
            [
                'type' => $result ? 'success' : 'error',
                'message' => $result ? 'ギャラリー画像を登録しました。' : 'ギャラリー画像を登録できませんでした。'
            ]
        );
    }

    public function edit($gallery_id)
    {
        $subtitle = '編集';
        $row = $this->gallery::find($gallery_id);

        if (!$row) {
            return redirect()->route('admin.gallery');
        }
        return view('admin.gallery.create.index', compact(['subtitle', 'row']));
    }

    public function update(GalleryRequest $request)
    {
        $row = $this->gallery::find($request->gallery_id);

        if (!$row) {
            return redirect()->route('admin.gallery');
        }

        $result = $this->gallery_service->update($request);

        return redirect()->route('admin.gallery')->with(
            [
                'type' => $result ? 'success' : 'error',
                'message' => $result ? 'ギャラリー画像を編集しました。' : 'ギャラリー画像を編集できませんでした。'
            ]
        );
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
            return redirect()->route('admin.gallery');
        }

        return view('admin.gallery.detail.index', compact(['row']));
    }

    /**
     * @param $gallery_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($gallery_id)
    {
        $gallery = Gallery::find($gallery_id);
        if (!$gallery) {
            return back()->with(['type' => 'error', 'message' => 'ギャラリー画像問い合わせを削除できませんでした。']);
        }
        $gallery->delete();

        return back()->with(['type' => 'success', 'message' => 'ギャラリー画像を削除しました。']);
    }

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