<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Position;
use App\Services\PositionService;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller
{
    public function __construct(private PositionService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Position::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $position = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($position, 201);
    }

    public function show(Position $position): JsonResponse
    {
        return response()->json($position);
    }

    public function update(GenericNameValueRequest $request, Position $position): JsonResponse
    {
        $updated = $this->service
            ->setPosition($position)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Position $position): JsonResponse
    {
        $this->service->delete($position);
        return response()->json(null, 204);
    }
}
