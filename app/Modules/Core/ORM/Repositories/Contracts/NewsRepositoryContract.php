<?php

declare(strict_types=1);

namespace App\Modules\Core\ORM\Repositories\Contracts;

use App\Models\News;
use App\Modules\Api\News\Filters\NewsFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface NewsRepositoryContract
{
    /**
     * @param  NewsFilter  $filter
     *
     * @return LengthAwarePaginator
     */
    public function getList(NewsFilter $filter): LengthAwarePaginator;

    /**
     * @param  string  $id
     *
     * @return News|null
     */
    public function getOneById(string $id): ?News;
}
