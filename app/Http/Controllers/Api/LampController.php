<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Lamp;
use App\Services\LampService;
use Illuminate\Http\JsonResponse;

class LampController extends Controller
{
    public function __construct(private LampService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Lamp::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $lamp = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($lamp, 201);
    }

    public function show(Lamp $lamp): JsonResponse
    {
        return response()->json($lamp);
    }

    public function update(GenericNameValueRequest $request, Lamp $lamp): JsonResponse
    {
        $updated = $this->service
            ->setLamp($lamp)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Lamp $lamp): JsonResponse
    {
        $this->service->delete($lamp);
        return response()->json(null, 204);
    }
}
