<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Models\Article;
use App\Repositories\Eloquent\Models\Writer;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class ArticleRepository
{
    protected $model;

    /**
     * 依存モデルの注入
     *
     * @param \App\Repositories\Eloquent\Models\Article $model
     */
    public function __construct(
        Article $model
    ) {
        $this->model = $model;
    }

    /**
     * 公開記事の取得
     * @param int|null $status
     * @param int|null $category
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function fetchPaginator(
        ?int $status = null,
        ?int $category = null
    ): LengthAwarePaginator {
        $articles = Article
            ::with([
                'category',
                'writer'
            ])
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category_id', $category);
            })
            ->orderBy('published_at', 'desc')
            ->paginate(5);

        return $articles;
    }

    /**
     * 記事の作成
     *
     * @param array $params
     * @param array $tagIdList
     * @return Article
     *
     * */
    public function create(array $params, array $tagIdList = []): Article
    {
        return \DB::transaction(function () use ($params, $tagIdList) {
            if (isset($params['tags'])) {
                unset($params['tags']);
            }
            $article = $this->model->create($params);
            $article->tags()->sync($tagIdList);

            return $article;
        });
    }

    /**
     * 記事の更新
     *
     * @param Article $article
     * @param array $params
     * @return bool
     *
     * */
    public function update(Article $article, array $params): bool
    {
        if (isset($params['tags'])) {
            $tags = $params['tags'];
            unset($params['tags']);
            $article->tags()->sync($tags);
        }

        return $article->update($params);
    }

    public function updateById(Article $article, array $params): bool
    {
        if (isset($params['tags'])) {
            $tags = $params['tags'];
            unset($params['tags']);
            $article->tags()->sync($tags);
        }

        return $this->model->findOrFail($article->id)->update($params);
    }

    /**
     * 記事更新または作成
     * @param Article $article
     * @param array $params
     * @return Article
     */
    public function updateOrCreate(Article $article, array $params): Article
    {
        return $this->model->updateOrCreate([
            'id' => $article->id,
        ], $params);
    }

    /**
     * 記事の詳細取得
     *
     * @param int $articleId
     * @return Article|null
     *
     * */
    public function findById(int $articleId): ?Article
    {
        return $this->model->with(
            [
                'category',
                'tags',
                'writer',
            ]
        )->find($articleId);
    }

    /**
     * 記事の削除
     *
     * @param Article $article
     * @return bool|null
     *
     * */
    public function delete(Article $article): ?bool
    {
        return $article->delete();
    }

    /**
     * ライターの記事取得
     *
     * @param int $articleId
     * @return Article|null
     *
     * */
    public function findByWriterId(int $id): Collection
    {
        return $this->model->where('writer_id', $id)->get();
    }
}
