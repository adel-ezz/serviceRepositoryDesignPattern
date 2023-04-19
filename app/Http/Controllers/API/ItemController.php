<?php

namespace App\Http\Controllers\API;


use App\Services\ItemServices;
use App\Http\Controllers\Controller;


class ItemController extends Controller
{
    //
    protected ItemServices $ItemServices;

    public function __construct(ItemServices $ItemServices)
    {
        $this->ItemServices = $ItemServices;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * Index
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->ItemServices->get();
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * Single item using id
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        return $this->ItemServices->show($id);
    }


}
