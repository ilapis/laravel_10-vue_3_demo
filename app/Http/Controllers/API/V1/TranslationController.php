<?php

namespace App\Http\Controllers\API\V1;

use App\Data\TranslationData;
use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationCreateRequest;
use App\Http\Requests\TranslationUpdateRequest;
use App\Http\Resources\TranslationResource;
use App\Models\Translation;
use App\Services\TranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TranslationController extends Controller
{
    public function __construct(private TranslationService $translationService)
    {

    }

    public function show(Translation $translation): TranslationResource
    {
        return new TranslationResource($translation);
    }

    public function locale(string $language_code): Response
    {
        $translations = Translation::query()
            ->whereHas('language', function ($query) use ($language_code) {
                $query->where('code', $language_code);
            })
            ->get(['group', 'key', 'value'])
            ->groupBy('group')
            ->map(function ($groupItems) {
                return $groupItems->pluck('value', 'key');
            })
            ->toArray();

        return response($translations);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $per_page = filter_var($request->get('per_page', 10), FILTER_VALIDATE_INT, ['options' => ['default' => 10, 'min_range' => 1]]);

        return TranslationResource::collection(
            $this->translationService->list($per_page)
        )->additional([
            'sortable' => ['id', 'language_id', 'key', 'name'],
            'filterable' => [
                'language_id' => ['exact'],
                'key' => ['contains'],
                'value' => ['contains'],
            ],
        ]);
    }

    public function store(TranslationCreateRequest $request): JsonResponse
    {
        $translationData = new TranslationData($request->validated());

        $translation = $this->translationService->create($translationData);

        return (new TranslationResource($translation))->response()->setStatusCode(201);
    }

    public function update(Translation $translation, TranslationUpdateRequest $request): TranslationResource
    {
        $translationData = new TranslationData($request->validated());

        $translation = $this->translationService->update(
            $translation,
            $translationData
        );

        return new TranslationResource($translation);
    }

    public function destroy(Translation $translation): Response
    {
        $this->authorize('delete', $translation);

        $translation->delete();

        return response(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
