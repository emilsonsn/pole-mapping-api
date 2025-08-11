<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Type;
use App\Services\TypeService;
use Illuminate\Http\JsonResponse;

class TypeController extends Controller
{
    public function __construct(private TypeService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Type::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $type = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($type, 201);
    }

    public function show(Type $type): JsonResponse
    {
        return response()->json($type);
    }

    public function update(GenericNameValueRequest $request, Type $type): JsonResponse
    {
        $updated = $this->service
            ->setType($type)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Type $type): JsonResponse
    {
        $this->service->delete($type);
        return response()->json(null, 204);
    }
}
