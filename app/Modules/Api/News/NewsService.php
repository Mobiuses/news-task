<?php

declare(strict_types=1);

namespace App\Modules\Api\News;

use App\Models\News;
use App\Modules\Api\News\Contracts\NewsServiceContract;
use App\Modules\Api\News\Exceptions\ArticleNotFoundException;
use App\Modules\Api\News\Filters\NewsFilter;
use App\Modules\Core\ORM\Managers\Contracts\NewsManagerContract;
use App\Modules\Core\ORM\Repositories\Contracts\NewsRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NewsService implements NewsServiceContract
{
    /**
     * @param  NewsManagerContract  $newsManager
     * @param  NewsRepositoryContract  $newsRepository
     */
    public function __construct(
        readonly private NewsManagerContract $newsManager,
        readonly private NewsRepositoryContract $newsRepository
    ) {
    }

    /**
     * @param  NewsFilter  $filter
     *
     * @return LengthAwarePaginator
     */
    public function getAllNews(NewsFilter $filter): LengthAwarePaginator
    {
        return $this->newsRepository->getList(
            $filter
        );
    }

    /**
     * @param  string  $id
     *
     * @return News
     * @throws ArticleNotFoundException
     */
    public function getOneArticleById(string $id): News
    {
        if ( ! $article = $this->newsRepository->getOneById($id)) {
            throw new ArticleNotFoundException;
        }

        return $article;
    }

    /**
     * @param  string  $id
     *
     * @return News
     * @throws ArticleNotFoundException
     */
    public function activeToggle(string $id): News
    {
        if ( ! $article = News::find($id)) {
            throw new ArticleNotFoundException;
        }

        return $this->newsManager->toggleActive($article);
    }
}
