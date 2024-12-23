<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function getCategoriesByApi()
    {
        $categories = $this->category->orderBy('category_id', 'asc')->get();
        return $categories->map(function ($record) {
            return [
                'categoryId' => $record->category_id,
                'name' => $record->name,
                'createdAt' => $record->created_at,
                'updatedAt' => $record->updated_at,
            ];
        });
    }
}