<?php

declare(strict_types=1);

namespace App\Modules\Api\News\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Api\News\Contracts\NewsServiceContract;
use App\Modules\Api\News\Exceptions\ArticleNotFoundException;
use App\Modules\Api\News\Filters\NewsFilter;
use App\Modules\Api\News\Resources\NewsCollection;
use App\Modules\Api\News\Resources\NewsResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    /**
     * @param  NewsServiceContract  $newsService
     */
    public function __construct(
        readonly private NewsServiceContract $newsService,
    ) {
    }

    /**
     * @param  NewsFilter  $filter
     *
     * @return AnonymousResourceCollection
     */
    public function list(NewsFilter $filter): AnonymousResourceCollection
    {
        return NewsCollection::collection(
            $this->newsService->getAllNews($filter)
        );
    }

    /**
     * @param  string  $id
     *
     * @return NewsResource
     */
    public function getOneArticleById(string $id): NewsResource
    {
        try {
            $article = $this->newsService->getOneArticleById($id);
        } catch (ArticleNotFoundException $e) {
            return $this->buildErrorResponse($e->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return NewsResource::make($article);
    }

    /**
     * @param  string  $id
     *
     * @return NewsResource|JsonResponse
     */
    public function activeToggle(string $id): NewsResource | JsonResponse
    {
        try {
            $article = $this->newsService->activeToggle($id);
        } catch (ArticleNotFoundException $e) {
            return $this->buildErrorResponse($e->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return NewsResource::make($article);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     *
     * @return JsonResponse
     */
    private function buildErrorResponse(string $message, int $code): JsonResponse
    {
        return response()->json([
            'status'   => 'error',
            'messages' => $message,
        ], $code);
    }
}
