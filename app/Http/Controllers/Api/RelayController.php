<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Relay;
use App\Services\RelayService;
use Illuminate\Http\JsonResponse;

class RelayController extends Controller
{
    public function __construct(private RelayService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Relay::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $relay = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($relay, 201);
    }

    public function show(Relay $relay): JsonResponse
    {
        return response()->json($relay);
    }

    public function update(GenericNameValueRequest $request, Relay $relay): JsonResponse
    {
        $updated = $this->service
            ->setRelay($relay)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Relay $relay): JsonResponse
    {
        $this->service->delete($relay);
        return response()->json(null, 204);
    }
}
