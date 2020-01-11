<?php

namespace App\Http\Controllers\Tr;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ArticleRepository;
use App\Repositories\Eloquent\Models\Article;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $articleRepository;

    public function __construct(
        ArticleRepository $articleRepository
    ) {
        $this->articleRepository = $articleRepository;
    }

    /**
     * 記事の取得
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $paginator = $this->articleRepository->fetchPaginator(
            $request->input('articleStatus'),
            $request->input('category')
        );

        return response()->json([
            'articles' => $paginator
        ]);
    }
}
