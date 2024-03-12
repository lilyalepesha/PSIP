<?php

namespace App\Http\Controllers\Api;

use App\Actions\MakeCarByAvCarsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CarStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    /**
     * @param CarStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(CarStoreRequest $request): JsonResponse
    {
        try {
            app()->make(MakeCarByAvCarsAction::class, [
                'response' => json_decode(json_encode($request->all()), false)
            ])->handle();

            return response()->json([
                'success' => true,
                'data' => true
            ]);
        } catch(\Exception $e) {
            Log::info(
                json_encode($request->all(), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)
            );

            report($e);

            return response()->json([
                'success' => false,
                'data' => 'Произошла ошибка на стороне сервера!'
            ]);
        }
    }
}
