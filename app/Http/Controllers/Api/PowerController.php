<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Power;
use App\Services\PowerService;
use Illuminate\Http\JsonResponse;

class PowerController extends Controller
{
    public function __construct(private PowerService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Power::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $power = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($power, 201);
    }

    public function show(Power $power): JsonResponse
    {
        return response()->json($power);
    }

    public function update(GenericNameValueRequest $request, Power $power): JsonResponse
    {
        $updated = $this->service
            ->setPower($power)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Power $power): JsonResponse
    {
        $this->service->delete($power);
        return response()->json(null, 204);
    }
}
