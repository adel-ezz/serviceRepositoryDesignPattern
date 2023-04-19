<?php

namespace App\Repositories;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\ItemResources;
use App\Models\Items;


class ItemRepository implements ItemRepositoryInterface
{
    use BaseApiController;

    /**
     * @var
     */
    protected Items $items;

    public function __construct(Items $items)
    {
        $this->items = $items;
    }

    function getAll(): \Illuminate\Http\JsonResponse
    {
        $items = $this->items->latest()->paginate(6);
        $data['items'] = ItemResources::collection($items);
        $data['paginate'] = [
            'total' => $items->total(),
            'count' => $items->count(),
            'current_page' => $items->currentPage(),
            'lastPAge' => $items->lastPage()
        ];
        return $this->apiResponse($data, [], '', '200');
    }

    function show($id): \Illuminate\Http\JsonResponse
    {
        $item = $this->items->find($id);
        return $this->apiResponse(ItemResources::make($item), [], '', '200');

    }
}
