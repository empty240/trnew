<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository
{
    protected $model;

    /**
     * 依存モデルの注入
     *
     * @param \App\Repositories\Eloquent\Models\Category $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * 一覧取得
     *
     * @return Collection
     *
     * */
    public function fetchAll(): Collection
    {
        return $this->model->get();
    }

    /**
     * カテゴリ名からID取得
     *
     * @param string $categoryName
     * @return int|null
     *
     * */
    public function findIdByCategoryName($categoryName): ?int
    {
        $category = $this->model->where('category_name', $categoryName)->first();
        if (! $category) {
            return null;
        }

        return $category->id;
    }
}
