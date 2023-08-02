<?php

namespace App\Http\Controllers\API\V1;

use App\Data\ArticleData;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    public function __construct(private readonly ArticleService $articleService)
    {

    }

    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $per_page = filter_var($request->get('per_page', 10), FILTER_VALIDATE_INT, ['options' => ['default' => 10, 'min_range' => 1]]);

        return ArticleResource::collection(
            $this->articleService->list($per_page)
        )->additional([
            'sortable' => ['id', 'language_id', 'title'],
            'filterable' => [
                'language_id' => ['exact'],
                'title' => ['contains'],
                'text' => ['contains'],
            ],
        ]);
    }

    public function store(ArticleData $articleData): JsonResponse
    {
        $insert = $articleData->authorize('create', Article::class);

        return (new ArticleResource($this->articleService->create($insert)))->response()->setStatusCode(201);
    }

    public function update(Article $article, ArticleData $articleData): ArticleResource
    {
        $update = $articleData->authorize('create', $article);
        $article = $this->articleService->update($article, $update);

        return new ArticleResource($article);
    }

    public function destroy(Article $article): Response
    {
        $this->authorize('delete', $article);

        $article->delete();

        return response(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
