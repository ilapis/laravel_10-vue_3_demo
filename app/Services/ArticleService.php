<?php

namespace App\Services;

use App\Data\ArticleData;
use App\Filters\ArticleFilter;
use App\Models\Article;
use App\Traits\OrderBy;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleService
{
    use OrderBy;

    /**
     * @return LengthAwarePaginator<Article>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Article::orderBy(...$this->orderBy(ArticleFilter::SORTABLE))->filter()->paginate($perPage)->withQueryString();
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

    public function delete(Article $article): ?Article
    {
        $article->delete();

        return $article->fresh();
    }
}
