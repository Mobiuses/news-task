<?php

declare(strict_types=1);

namespace App\Modules\Api\News\Exceptions;

use Exception;

class ArticleNotFoundException extends Exception
{
    /**
     * @param  string  $message
     */
    public function __construct(string $message = 'The article not found.')
    {
        parent::__construct($message);
    }
}
