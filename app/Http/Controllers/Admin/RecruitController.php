<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recruit;
use Illuminate\Routing\Controller;

class RecruitController extends Controller
{
    protected $recruit;
    public function __construct()
    {
        $this->recruit = app()->make(Recruit::class);
    }

    /**
     * 一覧
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $lists = $this->recruit::all()->sortByDesc('recruit_id');
        return view('admin.recruit.list.index', compact(['lists']));
    }

    /**
     * 詳細
     * @param $recruit_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function show($recruit_id)
    {
        $recruit = $this->recruit::find($recruit_id);

        if (!$recruit) {
            return redirect()->route('admin.recruit');
        }

        return view('admin.recruit.detail.index', compact(['recruit']));
    }

    /**
     * @param $recruit_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($recruit_id)
    {
        $recruit = Recruit::find($recruit_id);
        if (!$recruit) {
            return back()->with(['type' => 'error', 'message' => '応募を削除できませんでした。']);
        }
        $recruit->delete();

        return back()->with(['type' => 'success', 'message' => '応募を削除しました。']);
    }
}