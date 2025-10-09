<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Arm;
use App\Services\ArmService;
use Illuminate\Http\JsonResponse;

class ArmController extends Controller
{
    public function __construct(private ArmService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Arm::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $arm = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($arm, 201);
    }

    public function show(Arm $arm): JsonResponse
    {
        return response()->json($arm);
    }

    public function update(GenericNameValueRequest $request, Arm $arm): JsonResponse
    {
        $updated = $this->service
            ->setArm($arm)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Arm $arm): JsonResponse
    {
        $this->service->delete($arm);
        return response()->json(null, 204);
    }
}
