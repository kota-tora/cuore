<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\GalleryService;
use App\Http\Services\NewsService;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller
{
    protected $gallery_service;
    public function __construct(GalleryService $gallery_service)
    {
        $this->gallery_service = $gallery_service;
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function getUpGalleries(Request $request)
    {
        $type = $request->type ?? '';
        return response($this->gallery_service->getGalleryByApi($type), 200);
    }

    public function getUpYoutubeMovies()
    {
        return response($this->gallery_service->getYoutubeMoviesByApi(), 200);
    }

    public function getImagesParts(Request $request)
    {
        $page = $request->page ?? 1;
        return response($this->gallery_service->getImageGalleryByApi($page), 200);
    }
}