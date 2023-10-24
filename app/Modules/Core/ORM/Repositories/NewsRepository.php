<?php

declare(strict_types=1);

namespace App\Modules\Core\ORM\Repositories;

use App\Models\News;
use App\Modules\Api\News\Filters\NewsFilter;
use App\Modules\Core\ORM\Enums\NewsStatusEnum;
use App\Modules\Core\ORM\Repositories\Contracts\NewsRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NewsRepository implements NewsRepositoryContract
{
    /**
     * @param  NewsFilter  $filter
     *
     * @return LengthAwarePaginator
     */
    public function getList(NewsFilter $filter): LengthAwarePaginator
    {
        return $filter->getQuery()
                      ->where('status', NewsStatusEnum::ACTIVE->value)
                      ->paginate(perPage: $filter->getPerPage(), page: $filter->getPage());
    }

    /**
     * @param  string  $id
     *
     * @return News|null
     */
    public function getOneById(string $id): ?News
    {
        return News::find($id);
    }
}
