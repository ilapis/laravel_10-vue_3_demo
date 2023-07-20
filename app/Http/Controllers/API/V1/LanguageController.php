<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\LanguageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageCreateRequest;
use App\Http\Requests\LanguageUpdateRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LanguageController extends Controller
{
    public function __construct(private LanguageService $languageService)
    {

    }

    public function enabled(): JsonResponse
    {
        return response()->json(
            $this->languageService->enabled()
        );
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $languages = $this->languageService->list(
            $request->get('per_page', 3)
        );

        return LanguageResource::collection($languages);
    }

    public function store(Request $request, LanguageCreateRequest $languageCreateRequest): JsonResponse
    {
        $this->authorize('create', Language::class);

        return response()->json(
            $this->languageService->create(
                LanguageDTO::fromRequest($request)
            ),
            201
        );
    }

    public function update(Request $request, Language $language, LanguageUpdateRequest $languageUpdateRequest): JsonResponse
    {
        $this->authorize('update', $language);

        return response()->json(
            $this->languageService->update(
                $language,
                LanguageDTO::fromRequest($request, $language->id)
            )
        );
    }

    public function destroy(Language $language): JsonResponse
    {
        $this->authorize('delete', $language);

        $language->delete();

        return response()->json(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
