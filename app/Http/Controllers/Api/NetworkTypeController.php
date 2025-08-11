<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\NetworkType;
use App\Services\NetworkTypeService;
use Illuminate\Http\JsonResponse;

class NetworkTypeController extends Controller
{
    public function __construct(private NetworkTypeService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(NetworkType::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $networkType = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($networkType, 201);
    }

    public function show(NetworkType $networkType): JsonResponse
    {
        return response()->json($networkType);
    }

    public function update(GenericNameValueRequest $request, NetworkType $networkType): JsonResponse
    {
        $updated = $this->service
            ->setNetworkType($networkType)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(NetworkType $networkType): JsonResponse
    {
        $this->service->delete($networkType);
        return response()->json(null, 204);
    }
}
