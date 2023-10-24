<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\News;
use App\Modules\Api\News\Contracts\NewsServiceContract;
use App\Modules\Api\News\Filters\NewsFilter;
use App\Modules\Api\News\Resources\NewsCollection;
use App\Modules\Api\News\Resources\NewsResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var NewsServiceContract|mixed
     */
    private NewsServiceContract $newsService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->newsService = App::make(NewsServiceContract::class);
    }

    /**
     * A basic test example.
     */
    public function test_news_list_successful_response(): void
    {
        $news             = $this->newsService->getAllNews(new NewsFilter());
        $expectedResponse = NewsCollection::collection($news)->toResponse(Request::create('api/news'))->getContent();
        $response         = $this->get('/api/news');
        $actualResponse   = $response->getContent();

        $this->assertEquals(
            json_decode($expectedResponse, true)['data'],
            json_decode($actualResponse, true)['data']
        );
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * A basic test example.
     */
    public function test_news_get_one_by_id_successful_response(): void
    {
        $article          = $this->newsService->getOneArticleById(News::first()->getId());
        $expectedResponse = NewsResource::make($article)->toResponse(Request::create('api/news'))->getContent();
        $response         = $this->get("/api/news/{$article->getId()}");
        $actualResponse   = $response->getContent();

        $this->assertEquals(
            json_decode($expectedResponse, true)['data'],
            json_decode($actualResponse, true)['data']
        );
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * A basic test example.
     */
    public function test_news_get_one_by_id_not_found(): void
    {
        $response = $this->get("/api/news/zxc");

        $this->assertEquals(
            json_encode([
                'status'   => 'error',
                'messages' => 'The article not found.',
            ]),
            $response->getContent()
        );
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * A basic test example.
     */
    public function test_news_status_toggle_successful_response(): void
    {
        $article          = $this->newsService->getOneArticleById(News::first()->getId());
        $expectedResponse = NewsResource::make($article)->toResponse(Request::create('api/news'))->getContent();
        $response         = $this->get("/api/news/{$article->getId()}");
        $actualResponse   = $response->getContent();
        $article->refresh();

        $this->assertEquals(
            json_decode($expectedResponse, true)['data'],
            json_decode($actualResponse, true)['data']
        );
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * A basic test example.
     */
    public function test_news_status_toggle_not_found(): void
    {
        $response = $this->patch("/api/news/zxc");

        $this->assertEquals(
            json_encode([
                'status'   => 'error',
                'messages' => 'The article not found.',
            ]),
            $response->getContent()
        );
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
