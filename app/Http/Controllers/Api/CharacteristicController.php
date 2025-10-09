<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Characteristic;
use App\Services\CharacteristicService;
use Illuminate\Http\JsonResponse;

class CharacteristicController extends Controller
{
    public function __construct(private CharacteristicService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Characteristic::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $characteristic = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($characteristic, 201);
    }

    public function show(Characteristic $characteristic): JsonResponse
    {
        return response()->json($characteristic);
    }

    public function update(GenericNameValueRequest $request, Characteristic $characteristic): JsonResponse
    {
        $updated = $this->service
            ->setCharacteristic($characteristic)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Characteristic $characteristic): JsonResponse
    {
        $this->service->delete($characteristic);
        return response()->json(null, 204);
    }
}
