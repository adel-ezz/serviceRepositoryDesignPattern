<?php

namespace App\Services;

use App\Http\Controllers\API\BaseApiController;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Validator;

class OrderServices
{
    use BaseApiController;

    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * Make Order By User
     */
    public function saveOrder($data): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($data, [
            'items' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse((object)[], trans('something Error please try again'), $validator->messages(), '403');
        }
        return $this->orderRepository->save($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * Show Old Order By Id
     */

    public function show($id)
    {
        return $this->orderRepository->show($id);
    }

}
