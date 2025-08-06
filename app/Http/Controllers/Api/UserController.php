<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    use ApiResponseHelper;

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $response = $this->userService->getAllUsers();
        return $this->buildResponse($response);
    }

    public function store(StoreUserRequest $request)
    {
        $response = $this->userService->storeUser($request->validated());
        return $this->buildResponse($response);
    }

    public function show($id)
    {
        $response = $this->userService->getUserByID($id);
        return $this->buildResponse($response);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $response = $this->userService->updateUser($id, $request->validated());
        return $this->buildResponse($response);
    }

    public function destroy($id)
    {
        $response = $this->userService->destroy($id);
        return $this->buildResponse($response);
    }


}
