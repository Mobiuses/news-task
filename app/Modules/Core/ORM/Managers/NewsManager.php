<?php

declare(strict_types=1);

namespace App\Modules\Core\ORM\Managers;

use App\Models\News;
use App\Modules\Core\ORM\Managers\Contracts\NewsManagerContract;

class NewsManager implements NewsManagerContract
{
    /**
     * @param  News  $article
     *
     * @return News
     */
    public function toggleActive(News $article): News
    {
        if ($article->isActive()) {
            $article->setInActive();
        } else {
            $article->setActive();
        }

        $article->save();

        return $article;
    }
}
