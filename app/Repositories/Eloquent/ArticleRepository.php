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
     * @param int|null $articleType
     * @param string|null $format
     * @param string|null $keywords
     * @param string|null $publishWriter
     * @param bool|null $isNoIndex
     * @param bool|null $isPr
     * @param bool|null $isStealth
     * @param bool|null $isNoPager
     * @param bool|null $isHideAd
     * @param bool|null $isDisplayMateForm
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function fetchPaginatorPublished(
        ?int $status = null,
        ?int $category = null,
        ?int $articleType = null,
        ?string $format = null,
        ?string $keywords = null,
        ?string $publishWriter = null,
        ?bool $isNoIndex = false,
        ?bool $isPr = false,
        ?bool $isStealth = false,
        ?bool $isNoPager = false,
        ?bool $isHideAd = false,
        ?bool $isDisplayMateForm = false
    ): LengthAwarePaginator {
        // キーワードは半角スペースで分割してand検索にする
        $keywords = array_filter(explode(' ', $keywords));

        $articles = Article
            ::with([
                'articleType',
                'category',
                'writer',
                'publishWriter',
                'rewrite',
            ])
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category_id', $category);
            })
            ->when($articleType, function ($query) use ($articleType) {
                $query->where('article_type_id', $articleType);
            })
            ->when($format, function ($query) use ($format) {
                if ($format === Format::RICH()->getValue()) {
                    $query->where('is_rich', true);
                } elseif ($format === Format::VIDEO()->getValue()) {
                    $query->where('is_video', true);
                } else {
                    $query->where('is_rich', false);
                    $query->where('is_video', false);
                }
            })
            ->when(! empty($keywords), function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('id', (int) $keyword);
                        $query->orWhere('title', 'like', '%'.$keyword.'%');
                    });
                }
            })
            ->when($publishWriter, function ($query) use ($publishWriter) {
                $query->whereHas('publishWriter', function ($query) use ($publishWriter) {
                    $query->where('screen_name', $publishWriter);
                });
            })
            ->where(function ($query) use ($isNoIndex, $isPr, $isStealth, $isNoPager, $isHideAd, $isDisplayMateForm) {
                $query->when($isNoIndex, function ($query) {
                    $query->where('is_noindex', true);
                });
                $query->when($isPr, function ($query) {
                    $query->Where('is_pr', true);
                });
                $query->when($isStealth, function ($query) {
                    $query->Where('is_stealth', true);
                });
                $query->when($isNoPager, function ($query) {
                    $query->Where('is_nopager', true);
                });
                $query->when($isHideAd, function ($query) {
                    $query->Where('is_hide_ad', true);
                });
                $query->when($isDisplayMateForm, function ($query) {
                    $query->Where('is_display_mate_form', true);
                });
            })
            ->orderBy('published_at', 'desc')
            ->paginate(config('const.paginate.default_loading_column'));

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
