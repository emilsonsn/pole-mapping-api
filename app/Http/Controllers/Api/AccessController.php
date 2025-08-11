<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Access;
use App\Services\AccessService;
use Illuminate\Http\JsonResponse;

class AccessController extends Controller
{
    public function __construct(private AccessService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Access::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $access = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($access, 201);
    }

    public function show(Access $access): JsonResponse
    {
        return response()->json($access);
    }

    public function update(GenericNameValueRequest $request, Access $access): JsonResponse
    {
        $updated = $this->service
            ->setAccess($access)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Access $access): JsonResponse
    {
        $this->service->delete($access);
        return response()->json(null, 204);
    }
}
