<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\LanguageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageCreateRequest;
use App\Http\Requests\LanguageUpdateRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LanguageController extends Controller
{
    public function __construct(private readonly LanguageService $languageService)
    {

    }

    public function enabled(): Response
    {
        return LanguageResource::collection($this->languageService->enabled());
    }

    public function show(Language $language)
    {
        return new LanguageResource($language);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $per_page = filter_var($request->get('per_page', 10), FILTER_VALIDATE_INT, ['options' => ['default' => 10, 'min_range' => 1]]);

        return LanguageResource::collection(
            $this->languageService->list($per_page)
        );
    }

    public function store(Request $request, LanguageCreateRequest $languageCreateRequest): Response
    {
        $this->authorize('create', Language::class);

        $language = $this->languageService->create(
            LanguageDTO::fromRequest($request)
        );

        return response(new LanguageResource($language), 201);
    }

    public function update(Request $request, Language $language, LanguageUpdateRequest $languageUpdateRequest): Response
    {
        $this->authorize('update', $language);

        $language = $this->languageService->update(
            $language,
            LanguageDTO::fromRequest($request, $language->id)
        );

        return response(new LanguageResource($language));
    }

    public function destroy(Language $language): Response
    {
        $this->authorize('delete', $language);

        $language->delete();

        return response(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
