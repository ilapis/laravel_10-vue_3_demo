<?php

namespace App\Http\Controllers\API\V1;

use App\Data\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
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

    public function enabled(): AnonymousResourceCollection
    {
        //$this->authorize('view', User::class);

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

    public function store(UserCreateRequest $request): JsonResponse
    {
        $this->authorize('create', User::class);

        $userData = new UserData($request->validated());

        $user = $this->userService->create($userData);

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function update(User $user, UserUpdateRequest $request): UserResource
    {
        $this->authorize('update', $user);

        $userData = new UserData($request->validated());

        $user = $this->userService->update(
            $user,
            $userData
        );

        return new UserResource($user);
    }

    public function destroy(User $user): Response
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response(null, 204);  // 204 status code indicates successful deletion with no content in the response
    }
}
