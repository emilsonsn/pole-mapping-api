<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceRequest;
use App\Models\Maintenance;
use App\Services\MaintenanceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function __construct(private MaintenanceService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(
            Maintenance::orderBy('id', 'desc')->where('user_id', auth()->id())->get()
        );
    }

    public function store(MaintenanceRequest $request): JsonResponse
    {
        $maintenance = $this->service
            ->create($request->validated())
            ->getObject();

        return response()->json($maintenance, 201);
    }

    public function show(Maintenance $maintenance): JsonResponse
    {
        $this->authorizeAccess($maintenance);
        return response()->json($maintenance);
    }

    public function update(MaintenanceRequest $request, Maintenance $maintenance): JsonResponse
    {
        $this->authorizeAccess($maintenance);

        $updated = $this->service
            ->setMaintenance($maintenance)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Maintenance $maintenance): JsonResponse
    {
        $this->authorizeAccess($maintenance);

        $this->service->delete($maintenance);
        return response()->json(null, 204);
    }

    private function authorizeAccess(Maintenance $maintenance): void
    {
        abort_if($maintenance->user_id !== auth()->id(), 403, 'Unauthorized');
    }
}
