<?php

namespace App\Http\Controllers\API;

trait BaseApiController
{
    function apiResponse($result = [], $message = '', $error = [], $code = 200)
    {
        $response = [
            'status' => $code == 200 ? true : false,
            'data' => $result,
            'message'=>$message,
            'errors' => (object)$error
        ];
        return response()->json($response, $code, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    function mainPaginate($items)
    {
        return [
            'total' => $items->total(),
            'count' => $items->count(),
            'current_page'=> $items->currentPage(),
            'lastPAge'=> $items->lastPage()
        ];
    }
}
