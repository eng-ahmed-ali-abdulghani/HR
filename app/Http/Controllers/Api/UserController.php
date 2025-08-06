<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    use ApiResponseHelper;

    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = $this->userService->getAllUsers();
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function store(StoreUserRequest $request)
    {
        $data = $this->userService->storeUser($request->validated());
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function show($id)
    {
        $data = $this->userService->getUserByID($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $this->userService->updateUser($request->validated(), $id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function destroy($id)
    {
        $data = $this->userService->destroy($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }
}
