<?php

namespace App\Http\Controllers\API\V1;

use App\Data\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserDeleteRequest;
use App\Http\Requests\UserEnabledRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use App\Traits\PerPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use PerPage;

    public function __construct(private readonly UserService $userService)
    {

    }

    public function enabled(UserEnabledRequest $enabledRequest): AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->enabled());
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            $this->userService->list($this->perPage())
        )->additional([
            'sortable' => ['id', 'name', 'email'],
            'filterable' => [
                'name' => ['contains'],
                'email' => ['contains'],
            ],
        ]);
    }

    public function store(UserCreateRequest $createRequest, UserData $userData): JsonResponse
    {
        return (new UserResource($this->userService->create($userData)))->response()->setStatusCode(201);
    }

    public function update(UserUpdateRequest $updateRequest, User $user, UserData $userData): UserResource
    {
        return new UserResource($this->userService->update($user, $userData));
    }

    public function destroy(UserDeleteRequest $deleteRequest, User $user): Response
    {
        $this->userService->delete($user);

        return response(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
