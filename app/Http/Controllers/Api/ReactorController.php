<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Reactor;
use App\Services\ReactorService;
use Illuminate\Http\JsonResponse;

class ReactorController extends Controller
{
    public function __construct(private ReactorService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Reactor::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $reactor = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($reactor, 201);
    }

    public function show(Reactor $reactor): JsonResponse
    {
        return response()->json($reactor);
    }

    public function update(GenericNameValueRequest $request, Reactor $reactor): JsonResponse
    {
        $updated = $this->service
            ->setReactor($reactor)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Reactor $reactor): JsonResponse
    {
        $this->service->delete($reactor);
        return response()->json(null, 204);
    }
}
