<?php

namespace App\Http\Controllers\API\V1;

use App\Data\ArticleData;
use App\Filters\ArticleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleDeleteRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use App\Traits\PerPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    use PerPage;

    public function __construct(private readonly ArticleService $articleService)
    {

    }

    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return ArticleResource::collection(
            $this->articleService->list($this->perPage())
        )->additional([
            'sortable' => ArticleFilter::SORTABLE,
            'filterable' => ArticleFilter::FILTERABLE,
        ]);
    }

    public function store(ArticleCreateRequest $createRequest, ArticleData $articleData): JsonResponse
    {
        return (new ArticleResource($this->articleService->create($articleData)))->response()->setStatusCode(201);
    }

    public function update(ArticleUpdateRequest $updateRequest, Article $article, ArticleData $articleData): ArticleResource
    {
        return new ArticleResource($this->articleService->update($article, $articleData));
    }

    public function destroy(ArticleDeleteRequest $deleteRequest, Article $article): Response
    {
        $this->articleService->delete($article);

        return response(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
