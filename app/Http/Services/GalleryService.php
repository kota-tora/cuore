<?php

namespace App\Http\Services;

use App\Models\Gallery;
use App\Models\YoutubeMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryService
{
    protected $gallery;
    protected $youtube_movie;

    public function __construct(Gallery $gallery, YoutubeMovie $youtube_movie)
    {
        $this->gallery = $gallery;
        $this->youtube_movie = $youtube_movie;
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function getGalleryByApi($type = 'image')
    {
        $galleries = $this->gallery->where('up_flg', 1)
            ->where('type', $type)
            ->orderBy('photo_date', 'desc')
            ->orderBy('gallery_id', 'desc')
            ->get();
        return $galleries->map(function ($record) {
            return [
                'galleryId' => $record->gallery_id,
                'name' => $record->name,
                'title' => $record->title,
                'upFlg' => $record->up_flg,
                'photoDate' => $record->photo_date,
                'createdAt' => $record->created_at,
                'updatedAt' => $record->updated_at,
            ];
        });
    }

    /**
     * @param $page
     * @return mixed
     */
    public function getImageGalleryByApi($page)
    {
        $perPage = 10; // 1回のリクエストで取得する件数

        $galleries = $this->gallery->where('up_flg', 1)
            ->where('type', 'image')
            ->orderBy('photo_date', 'desc')
            ->orderBy('gallery_id', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
        return $galleries->map(function ($record) {
            return [
                'galleryId' => $record->gallery_id,
                'name' => $record->name,
                'title' => $record->title,
                'upFlg' => $record->up_flg,
                'photoDate' => $record->photo_date,
                'createdAt' => $record->created_at,
                'updatedAt' => $record->updated_at,
            ];
        });
    }

    /**
     * @return mixed
     */
    public function getYoutubeMoviesByApi()
    {
        $galleries = $this->youtube_movie
            ->where('up_flg', 1)
            ->orderBy('filming_date', 'desc')
            ->orderBy('youtube_movie_id', 'desc')
            ->get();

        return $galleries->map(function ($record) {
            return [
                'youtubeMovieId' => $record->youtube_movie_id,
                'url' => $record->url,
                'title' => $record->title,
                'upFlg' => $record->up_flg,
                'filmingDate' => $record->filming_date,
                'createdAt' => $record->created_at,
                'updatedAt' => $record->updated_at,
            ];
        });
    }

    public function getYoutubeMoviesPartsByApi($page)
    {
        $perPage = 10; // 1回のリクエストで取得する件数
        $galleries = $this->youtube_movie
            ->where('up_flg', 1)
            ->orderBy('filming_date', 'desc')
            ->orderBy('youtube_movie_id', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return $galleries->map(function ($record) {
            return [
                'youtubeMovieId' => $record->youtube_movie_id,
                'url' => $record->url,
                'title' => $record->title,
                'upFlg' => $record->up_flg,
                'filmingDate' => $record->filming_date,
                'createdAt' => $record->created_at,
                'updatedAt' => $record->updated_at,
            ];
        });
    }

    /**
     * @param  Request  $request
     * @return bool
     */
    public function create(Request $request)
    {
        if (!$request->hasFile('image')) {
            return false;
        }

        $file = $request->file('image');
        $file_name = Str::random(20) . '.' . $file->getClientOriginalExtension();

        $file->storeAs(
            'public/images/gallery',
            $file_name
        );

        $this->gallery->create([
            'name' => $file_name,
            'title' => $request->title,
            'type' => $request->type,
            'photo_date' => $request->photo_date,
            'up_flg' => $request->up_flg,
        ]);

        return true;
    }

    /**
     * @param  Request  $request
     * @return bool
     */
    public function update(Request $request)
    {
        $gallery = $this->gallery->find($request->gallery_id);
        if (!$gallery) {
            return false;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = Str::random(20) . '.' . $file->getClientOriginalExtension();

            $file->storeAs(
                'public/images/gallery',
                $file_name
            );
        }

        $update_data = [
            'title' => $request->title,
            'photo_date' => $request->photo_date,
            'up_flg' => $request->up_flg,
        ];

        if (!empty($file_name)) {
            $update_data['name'] = $file_name;
        }

        $gallery->update($update_data);

        return true;
    }
}