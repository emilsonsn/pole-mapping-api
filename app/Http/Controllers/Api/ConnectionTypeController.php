<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\ConnectionType;
use App\Services\ConnectionTypeService;
use Illuminate\Http\JsonResponse;

class ConnectionTypeController extends Controller
{
    public function __construct(private ConnectionTypeService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(ConnectionType::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $connectionType = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($connectionType, 201);
    }

    public function show(ConnectionType $connectionType): JsonResponse
    {
        return response()->json($connectionType);
    }

    public function update(GenericNameValueRequest $request, ConnectionType $connectionType): JsonResponse
    {
        $updated = $this->service
            ->setConnectionType($connectionType)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(ConnectionType $connectionType): JsonResponse
    {
        $this->service->delete($connectionType);
        return response()->json(null, 204);
    }
}
