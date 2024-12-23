<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    protected $blog;
    public function __construct()
    {
        $this->blog = app()->make(Blog::class);
    }

    /**
     * 一覧
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $lists = $this->blog::all()->sortByDesc('blog_id');
        return view('admin.blog.list.index', compact(['lists']));
    }

    /**
     * 詳細
     * @param $blog_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function show($blog_id)
    {
        $blog = $this->blog::find($blog_id);

        if (!$blog) {
            return redirect()->route('admin.blog');
        }

        return view('admin.blog.detail.index', compact(['blog']));
    }

    /**
     * @param $blog_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($blog_id)
    {
        $blog = Blog::find($blog_id);
        if (!$blog) {
            return back()->with(['type' => 'error', 'message' => 'ブログ問い合わせを削除できませんでした。']);
        }
        $blog->delete();

        return back()->with(['type' => 'success', 'message' => 'ブログを削除しました。']);
    }
}