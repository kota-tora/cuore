<?php

namespace App\Http\Services;

use App\Models\News;

class NewsService
{
    protected $news;
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getUpNews($limit = null)
    {
        $news = $this->news->getUps($limit);

        return $news->map(function ($record) {
            return [
                'newsId' => $record->news_id,
                'title' => $record->title,
                'content' => $record->content,
                'upDateTime' => $record->up_date_time,
                'createdAt' => $record->created_at,
            ];
        });
    }

    /**
     * @param $id
     * @param $up_flg
     * @return mixed
     */
    public function getNews($id, $up_flg = true)
    {
        return $this->news->getNews($id, $up_flg);
    }
}