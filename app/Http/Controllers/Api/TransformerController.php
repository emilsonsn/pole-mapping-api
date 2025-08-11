<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Transformer;
use App\Services\TransformerService;
use Illuminate\Http\JsonResponse;

class TransformerController extends Controller
{
    public function __construct(private TransformerService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Transformer::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $transformer = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($transformer, 201);
    }

    public function show(Transformer $transformer): JsonResponse
    {
        return response()->json($transformer);
    }

    public function update(GenericNameValueRequest $request, Transformer $transformer): JsonResponse
    {
        $updated = $this->service
            ->setTransformer($transformer)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Transformer $transformer): JsonResponse
    {
        $this->service->delete($transformer);
        return response()->json(null, 204);
    }
}
