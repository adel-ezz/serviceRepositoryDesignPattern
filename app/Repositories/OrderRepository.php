<?php

namespace App\Repositories;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\OrderResorces;
use App\Models\Items;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderRepositoryInterface
{
    use BaseApiController;

    /**
     * @var
     */
    protected $order;

    public function __construct(Orders $order)
    {
        $this->order = $order;
    }


    function save($data): \Illuminate\Http\JsonResponse
    {

        $order = new $this->order;
        $order->user_id = Auth::user()->id;
        $order->save();
        $order->Items()->attach($this->arrangeArray($data['items']));
        return $this->apiResponse(OrderResorces::make($order->fresh()), '', '','200');

    }

    ///=====For arrange item for pivot table
    function arrangeArray($data): array
    {
        $attached = [];
        foreach ($data as $item) {
            $element = Items::find($item);
            $attached[$item] = ['current_price' => $element->price];
        }
        return $attached;
    }


    ///=====Show =======////
    function show($id): \Illuminate\Http\JsonResponse
    {

        $order = $this->order->where('id', $id)->where('user_id', \auth()->id())->first();

        if ($order) {
            return $this->apiResponse(OrderResorces::make($order), [], '','200');
        }
        return $this->apiResponse((object)[], trans('not found'), [], '403');


    }
}
