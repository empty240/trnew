<?php

namespace Tests\Feature\Controllers\Tr;

use App\Repositories\Eloquent\Models\Article;
use App\Repositories\Eloquent\Models\Category;
use App\Repositories\Eloquent\Models\Tag;
use App\Repositories\Eloquent\Models\Writer;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    // 一覧取得確認
    public function testIndex()
    {
        $articles = factory(Article::class, 10)->create();
        $response = $this->getJson($this->trDomain.'/api/articles');
        $response->assertStatus(200);
        $result = json_decode($response->content());

        $this->assertEquals(10, $result->articles->total);
        $this->assertEquals(5, count($result->articles->data));
    }
}
