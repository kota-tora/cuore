<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recruit;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    /**
     * 一覧
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('admin.index');
    }
}