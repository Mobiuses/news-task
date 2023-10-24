<?php

declare(strict_types=1);

namespace App\Modules\Api\News\Routes;

use App\Modules\Api\News\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/news')->middleware(['api'])->group(static function () {
    Route::get('/', [NewsController::class, 'list']);
    Route::get('/{newsId}', [NewsController::class, 'getOneArticleById'])->name('news_get_one');
    Route::patch('/{newsId}', [NewsController::class, 'activeToggle']);
});
