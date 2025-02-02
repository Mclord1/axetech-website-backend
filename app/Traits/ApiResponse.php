<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse
{
    protected function successResponse($data = null, string $message = 'Request processed successfully', int $code = 200, array $meta = []): JsonResponse
    {
        $response = [
            'status' => 'success',
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'meta' => $meta
        ];

        if ($data instanceof LengthAwarePaginator) {
            $response['meta'] = array_merge($meta, [
                'total' => $data->total(),
                'page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total_pages' => $data->lastPage()
            ]);
            $response['data'] = $data->items();
        }

        return response()->json($response, $code);
    }

    protected function errorResponse(string $message, int $code = 400, array $errors = [], array $meta = []): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
            'meta' => $meta
        ], $code);
    }
}
