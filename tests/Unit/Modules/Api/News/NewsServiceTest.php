<?php

declare(strict_types=1);

namespace Modules\Api\News;

use App\Modules\Api\News\Contracts\NewsServiceContract;
use App\Modules\Api\News\Exceptions\ArticleNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class NewsServiceTest extends TestCase
{
    use CreatesApplication, RefreshDatabase;

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

        $this->newsService = App::make(NewsServiceContract::class);
    }

    /**
     * @return void
     * @throws ArticleNotFoundException
     */
    public function testActiveToggleException()
    {
        $this->expectException(ArticleNotFoundException::class);
        $this->expectExceptionMessage('The article not found.');

        $this->newsService->getOneArticleById('zxc');
    }

    /**
     * @return void
     * @throws ArticleNotFoundException
     */
    public function testGetOneArticleByIdException()
    {
        $this->expectException(ArticleNotFoundException::class);
        $this->expectExceptionMessage('The article not found.');

        $this->newsService->activeToggle('zxc');
    }
}
