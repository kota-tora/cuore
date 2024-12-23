<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\NewsService;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    protected $news_service;
    public function __construct(NewsService $news_service)
    {
        $this->news_service = $news_service;
    }

    /**
     * 公開中のニュース一覧取得
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function getUpNews(Request $request)
    {
        $limit = $request->limit ?? null;
        return response($this->news_service->getUpNews($limit), 200);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function getNews(Request $request)
    {
        $id = $request->id;
        if ($id) {
            return response($this->news_service->getNews($id), 200);
        } else {
            return response([], 500);
        }
    }
}