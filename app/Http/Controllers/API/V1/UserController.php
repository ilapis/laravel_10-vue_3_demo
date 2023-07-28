<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {

    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $per_page = filter_var($request->get('per_page', 10), FILTER_VALIDATE_INT, ['options' => ['default' => 10, 'min_range' => 1]]);

        return UserResource::collection(
            $this->userService->list($per_page)
        )->additional([
            'sortable' => ['id', 'name', 'email'],
            'filterable' => [
                'name' => ['contains'],
                'email' => ['contains'],
            ],
        ]);
    }

    public function store(UserCreateRequest $userCreateRequest): JsonResponse
    {
        $this->authorize('create', User::class);

        $user = $this->userService->create(
            UserDTO::fromRequest($userCreateRequest)
        );

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function update(User $user, UserUpdateRequest $userUpdateRequest): UserResource
    {
        $this->authorize('update', $user);

        $user = $this->userService->update(
            $user,
            UserDTO::fromRequest($userUpdateRequest)
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
