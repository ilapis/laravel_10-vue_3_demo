<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\TranslationDTO;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\TranslationService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TranslationResource;
use App\Http\Requests\TranslationCreateRequest;
use App\Http\Requests\TranslationUpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TranslationController extends Controller
{
    public function __construct(private TranslationService $translationService)
    {

    }

    public function show(Translation $translation)
    {
        return new TranslationResource($translation);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $per_page = filter_var($request->get('per_page', 10), FILTER_VALIDATE_INT, ['options' => ['default' => 10, 'min_range' => 1]]);

        return TranslationResource::collection(
            $this->translationService->list($per_page)
        );
    }

    public function store(Request $request, TranslationCreateRequest $translationCreateRequest): JsonResponse
    {
        $this->authorize('create', Translation::class);
/*
        return response()->json(
            $this->translationService->create(
                TranslationDTO::fromRequest($request)
            ),
            201
        );
*/
        $translation = $this->translationService->create(
            TranslationDTO::fromRequest($request)
        );

        return response(new TranslationResource($translation), 201);
    }

    public function update(Request $request, Translation $translation, TranslationUpdateRequest $translationUpdateRequest): JsonResponse
    {
        $this->authorize('update', $translation);
/*
        return response()->json(
            $this->translationService->update(
                $translation,
                TranslationDTO::fromRequest($request, $translation->id)
            )
        );
        */
        $translation = $this->translationService->update(
            $translation,
            TranslationDTO::fromRequest($request, $translation->id)
        );

        return new TranslationResource($translation);
    }

    public function destroy(Translation $translation): JsonResponse
    {
        $this->authorize('delete', $translation);

        $translation->delete();

        return response()->json(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
