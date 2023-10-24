<?php

declare(strict_types=1);

namespace App\Modules\Core\ORM\Managers\Contracts;

use App\Models\News;
use App\Modules\Core\DTOs\TaskDTO;

interface NewsManagerContract
{
    /**
     * @param  News  $article
     *
     * @return News
     */
    public function toggleActive(News $article): News;

}
