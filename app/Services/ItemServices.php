<?php

namespace App\Services;

use App\Repositories\ItemRepository;

class ItemServices
{
    protected ItemRepository $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * GETALL
     */
    public function get(): \Illuminate\Http\JsonResponse
    {
        return $this->itemRepository->getAll();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * SHow Single By Id
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        return $this->itemRepository->show($id);
    }

}
