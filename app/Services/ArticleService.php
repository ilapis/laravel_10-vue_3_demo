<?php

namespace App\Services;

use App\Data\ArticleData;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleService
{
    /**
     * @return LengthAwarePaginator<Article>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Article::orderBy('id', 'desc')->filter()->paginate($perPage)->withQueryString();
    }

    public function create(ArticleData $articleData): Article
    {
        return Article::create($articleData->toArray());
    }

    public function update(Article $article, ArticleData $articleData): ?Article
    {
        $article->update($articleData->toArray());

        return $article->fresh();
    }
}
