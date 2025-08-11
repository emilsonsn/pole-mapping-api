<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenericNameValueRequest;
use App\Models\Paving;
use App\Services\PavingService;
use Illuminate\Http\JsonResponse;

class PavingController extends Controller
{
    public function __construct(private PavingService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(Paving::all());
    }

    public function store(GenericNameValueRequest $request): JsonResponse
    {
        $paving = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($paving, 201);
    }

    public function show(Paving $paving): JsonResponse
    {
        return response()->json($paving);
    }

    public function update(GenericNameValueRequest $request, Paving $paving): JsonResponse
    {
        $updated = $this->service
            ->setPaving($paving)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Paving $paving): JsonResponse
    {
        $this->service->delete($paving);
        return response()->json(null, 204);
    }
}
