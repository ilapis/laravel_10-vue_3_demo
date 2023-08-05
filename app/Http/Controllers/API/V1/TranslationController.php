<?php

namespace App\Http\Controllers\API\V1;

use App\Data\TranslationData;
use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationCreateRequest;
use App\Http\Requests\TranslationDeleteRequest;
use App\Http\Requests\TranslationUpdateRequest;
use App\Http\Resources\TranslationResource;
use App\Models\Translation;
use App\Services\TranslationService;
use App\Traits\PerPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TranslationController extends Controller
{
    use PerPage;

    public function __construct(private TranslationService $translationService)
    {

    }

    public function show(Translation $translation): TranslationResource
    {
        return new TranslationResource($translation);
    }

    public function locale(string $language_code): Response
    {
        return response($this->translationService->locale($language_code));
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return TranslationResource::collection(
            $this->translationService->list($this->perPage())
        )->additional([
            'sortable' => ['id', 'language_id', 'key', 'name'],
            'filterable' => [
                'language_id' => ['exact'],
                'key' => ['contains'],
                'value' => ['contains'],
            ],
        ]);
    }

    public function store(TranslationCreateRequest $createRequest, TranslationData $translationData): JsonResponse
    {
        return (new TranslationResource($this->translationService->create($translationData)))->response()->setStatusCode(201);
    }

    public function update(TranslationUpdateRequest $updateRequest, Translation $translation, TranslationData $translationData): TranslationResource
    {
        return new TranslationResource($this->translationService->update($translation, $translationData));
    }

    public function destroy(TranslationDeleteRequest $deleteRequest, Translation $translation): Response
    {
        $this->translationService->delete($translation);

        return response(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
