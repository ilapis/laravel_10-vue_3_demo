<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationCreateRequest;
use App\Http\Requests\TranslationUpdateRequest;
use App\Models\Translation;
use App\Services\TranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\DTO\TranslationDTO;

class TranslationController extends Controller
{
    public function __construct(private TranslationService $translationService)
    {

    }

    public function index(): JsonResponse
    {
        return response()->json(
            $this->translationService->listTranslations()
        );
    }

    public function store(Request $request, TranslationCreateRequest $translationCreateRequest): JsonResponse
    {
        $this->authorize('create', Translation::class);

        return response()->json(
            $this->translationService->create(
                TranslationDTO::fromRequest($request)
            ),
            201
        );
    }

    public function update(Request $request, Translation $translation, TranslationUpdateRequest $translationUpdateRequest): JsonResponse
    {
        $this->authorize('update', $translation);

        return response()->json(
            $this->translationService->update(
                $translation,
                TranslationDTO::fromRequest($request, $translation->id)
            )
        );
    }

    public function destroy(Translation $translation): JsonResponse
    {
        $this->authorize('delete', $translation);

        $translation->delete();

        return response()->json(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
