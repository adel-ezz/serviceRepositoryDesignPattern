<?php

namespace App\Services;

use App\Http\Controllers\API\BaseApiController;
use App\Repositories\ItemRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserServices
{
    use BaseApiController;

    protected UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * Login Service
     */
    public function login($data): \Illuminate\Http\JsonResponse
    {

        $validator = Validator::make($data, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email' => trans('items'),
            'password' => trans('password')
        ]);
        if ($validator->fails()) {
            return $this->apiResponse((object)[], '', $validator->errors(), '403');

        }
        return $this->UserRepository->login($data);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * Register Service
     */
    public function register($data): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($data, [
            'email' => 'required|email|unique:users,email',
            'name'=>'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse((object)[], '', $validator->errors(), '403');

        }
        return $this->UserRepository->register($data);
    }

}
