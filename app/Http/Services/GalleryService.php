<?php

namespace App\Http\Services;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryService
{
    protected $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function getGalleryByApi($type = 'image')
    {
        $galleries = $this->gallery->where('up_flg', 1)->where('type', $type)->get();
        return $galleries->map(function ($record) {
            return [
                'galleryId' => $record->category_id,
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