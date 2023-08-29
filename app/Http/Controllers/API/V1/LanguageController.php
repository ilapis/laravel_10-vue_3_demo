<?php

namespace App\Http\Controllers\API\V1;

use App\Data\LanguageData;
use App\Filters\LanguageFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageCreateRequest;
use App\Http\Requests\LanguageDeleteRequest;
use App\Http\Requests\LanguageUpdateRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use App\Services\LanguageService;
use App\Traits\PerPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LanguageController extends Controller
{
    use PerPage;

    public function __construct(private readonly LanguageService $languageService)
    {

    }

    public function enabled(): AnonymousResourceCollection
    {
        return LanguageResource::collection($this->languageService->enabled());
    }

    public function all(): AnonymousResourceCollection
    {
        return LanguageResource::collection($this->languageService->all());
    }

    public function show(Language $language): LanguageResource
    {
        return new LanguageResource($language);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return LanguageResource::collection(
            $this->languageService->list($this->perPage())
        )->additional([
            'sortable' => LanguageFilter::SORTABLE,
            'filterable' => LanguageFilter::FILTERABLE,
        ]);
    }

    public function store(LanguageCreateRequest $createRequest, LanguageData $languageData): JsonResponse
    {
        return (new LanguageResource($this->languageService->create($languageData)))->response()->setStatusCode(201);
    }

    public function update(LanguageUpdateRequest $updateRequest, Language $language, LanguageData $languageData): LanguageResource
    {
        return new LanguageResource($this->languageService->update($language, $languageData));
    }

    public function destroy(LanguageDeleteRequest $deleteRequest, Language $language): Response
    {
        $this->languageService->delete($language);

        return response(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
