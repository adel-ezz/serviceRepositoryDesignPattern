<?php

namespace App\Repositories;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\ItemResources;
use App\Http\Resources\UserResource;
use App\Models\Items;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserRepository implements UserRepositoryInterface
{
    use BaseApiController;

    /**
     * @var
     */
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    ///=====================register============================//
    public function register($data): \Illuminate\Http\JsonResponse
    {
        $data['password'] = bcrypt($data['password']);
        $user = $this->user->create($data);

        $token = $user->createToken('starsSmile')->accessToken;
        ////=======Collection Filter============////
        $userC = User::where('id', $user->id)->first();
        $user = new UserResource($user);
        $data = ['user' => $user, 'token' => $token];
        return $this->apiResponse($data, '', [], 200);
    }


    ///=====================Login============================//
    public function login($data): \Illuminate\Http\JsonResponse
    {
        $user = $this->user->where('email', $data['email'])->first();
        $usingEmail = Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
        if ($usingEmail && $user) {
            $token = $user->createToken('ServiceRepository')->accessToken;
            $user = new UserResource($user);
            $data = ['user' => $user, 'token' => $token];
            return $this->apiResponse($data, '', [], '200');

        } else {
            return $this->apiResponse('', trans('something Error please try again'), ['message' => [trans('something Error please try again')]], '422');
        }

    }
}
