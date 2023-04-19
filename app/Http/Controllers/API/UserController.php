<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Services\UserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{

    protected UserServices $user;

    public function __construct(UserServices $user)
    {
        $this->user = $user;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Register
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {

        return $this->user->register($request->all());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Login
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->user->login($request->all());
    }


}
