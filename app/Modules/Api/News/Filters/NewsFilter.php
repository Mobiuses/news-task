<?php

declare(strict_types=1);

namespace App\Modules\Api\News\Filters;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;

class NewsFilter extends QueryFilter
{
    /**
     * @param  Builder|null  $builder
     *
     * @return Builder
     */
    public function getQuery(Builder $builder = null): Builder
    {
        $this->builder = $builder ?: News::query();

        if (isset($this->request)) {
            $this->page    = ((int) $this->request->get('page')) ?: $this->page;
            $this->perPage = ((int) $this->request->get('per_page')) ?: $this->perPage;
        }

        return $this->builder;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
