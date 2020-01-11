<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Models\Writer;
use DB;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Log;

/*
 *
 * 管理権限ユーザー用リポジトリ
 *
 * */
class WriterRepository
{
    protected $model;

    /**
     * コンストラクタ
     *
     * 依存モデルの注入
     *
     * @param Writer $model
     */
    public function __construct(Writer $model)
    {
        $this->model = $model;
    }

    /**
     * ライター名で検索する
     *
     * @param string $writerName
     * @return Writer or null
     */
    public function findByWriterName(string $writerName): ?Writer
    {
        return $this->model
            ->where('writer_name', $writerName)
            ->first();
    }

    /**
     * 全件取得
     *
     * @return Collection
     */
    public function fetchAllValidUser(): Collection
    {
        return $this->model
                    ->validWriter()
                    ->orderBy('id', 'desc')
                    ->get();
    }

    /**
     * IDで検索する
     *
     * @param int $id
     * @return Writer or null
     */
    public function findById(int $id): ?Writer
    {
        return $this->model->find($id);
    }

    /**
     * 一覧取得（ページャー）
     *
     * @params array $params
     * @params array $columns
     * @return LengthAwarePaginator
     */
    public function fetchPaginator(array $params = [], array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model
                    ->validWriter()
                    ->with('managementAdmin:id,name')
                    // name検索
                    ->when(isset($params['writer_name']),
                        function ($q) use ($params) {
                            return $q->where('writer_name', 'like', '%'.$params['writer_name'].'%');
                        }
                    )
                    ->orderBy('id', 'desc')
                    ->paginate(config('const.paginate.default_loading_column'), $columns);
    }

    /**
     * 無効ライター一覧取得（ページャー）
     *
     * @params array $params
     * @params array $columns
     * @return LengthAwarePaginator
     */
    public function fetchInvalidPaginator(array $params = [], array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model
            ->invalidWriter()
            // name検索
            ->when(isset($params['writer_name']),
                function ($q) use ($params) {
                    return $q->where('writer_name', 'like', '%'.$params['writer_name'].'%');
                }
            )
            ->orderBy('id', 'desc')
            ->paginate(config('const.paginate.default_loading_column'), $columns);
    }
}
