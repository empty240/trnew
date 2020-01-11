<?php

namespace Tests\Unit\Repositories\Eloquent;

use App\Repositories\Eloquent\ArticleRepository;
use App\Repositories\Eloquent\Models\Article;
use App\Repositories\Eloquent\Models\Category;
use App\Repositories\Eloquent\Models\Tag;
use App\Repositories\Eloquent\Models\Writer;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Article
    */
    private $model;

    /**
     * @var ArticleRepository
    */
    private $repo;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = \App::make(Article::class);
        $this->repo = \App::make(ArticleRepository::class);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreate()
    {
        factory(Article::class, 2)->create();
        $articles = Article::get();
        $this->assertEquals(2, $articles->count());
    }
}
