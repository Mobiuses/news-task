<?php

declare(strict_types=1);

namespace App\Modules\Api\News\Contracts;

use App\Models\News;
use App\Modules\Api\News\Exceptions\ArticleNotFoundException;
use App\Modules\Api\News\Filters\NewsFilter;
use App\Modules\Core\DTOs\TaskDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface NewsServiceContract
{
    /**
     * @param  NewsFilter  $filter
     *
     * @return LengthAwarePaginator
     */
    public function getAllNews(NewsFilter $filter): LengthAwarePaginator;

    /**
     * @param  string  $id
     *
     * @return News
     * @throws ArticleNotFoundException
     */
    public function getOneArticleById(string $id): News;

    /**
     * @param  string  $id
     *
     * @return News
     * @throws ArticleNotFoundException
     */
    public function activeToggle(string $id): News;
}
