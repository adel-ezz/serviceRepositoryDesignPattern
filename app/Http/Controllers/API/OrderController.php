<?php

namespace App\Http\Controllers\API;

use App\Services\OrderServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    //

    protected OrderServices $OrderServices;

    public function __construct(OrderServices $OrderServices)
    {
        $this->OrderServices = $OrderServices;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Store
     */
    public function store(Request $request)
    {
       return $this->OrderServices->saveOrder($request->all());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * Show
     */
    public function show($id)
    {
        return $this->OrderServices->show($id);

    }





}
