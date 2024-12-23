<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'up_date_time'
    ];

    protected $casts = [
        'up_date_time' => 'immutable_datetime'
    ];

    /**
     * 公開中のニュース一覧を取得
     * @return mixed
     */
    public function getUps($limit = null)
    {
        $query = $this->whereNotNull('up_date_time')
            ->where('up_date_time', '<=', Carbon::now())
            ->orderBy('up_date_time', 'desc');

        if ($limit) {
            $query->limit($limit);
        }
        return $query->get();
    }

    /**
     * is_upがtrueなら公開済みのニュースを１件取得、falseなら公開非公開にかかわらず取得する
     *
     * @param  int  $id
     * @param  bool  $is_up
     * @return mixed
     */
    public function getNews(int $id, bool $is_up = true)
    {
        if ($is_up) {
            $result = $this->where('news_id', $id)
                ->where('up_date_time', '<=', Carbon::now())
                ->first();
        } else {
            $result = $this->find($id);
        }
        return $result;
    }
}