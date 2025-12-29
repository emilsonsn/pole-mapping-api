<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceRequest;
use App\Models\Maintenance;
use App\Services\MaintenanceService;
use Carbon\Carbon;
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

    public function list(Request $request): JsonResponse
    {
        $data = $request->validate([
            'search' => ['nullable','string'],
            'page' => ['nullable','integer','min:1'],
            'take' => ['nullable','integer','in:10,25,50,100'],
            'order_field' => ['nullable','in:created_at,address'],
            'order' => ['nullable','in:ASC,DESC'],
            'start' => ['nullable','date'],
            'end' => ['nullable','date'],
        ]);

        $page = $data['page'] ?? 1;
        $take = $data['take'] ?? 10;
        $orderField = $data['order_field'] ?? 'created_at';
        $orderDir = $data['order'] ?? 'DESC';
        $search = $data['search'] ?? null;
        $start = $data['start'] ?? null;
        $end = $data['end'] ?? null;

        $query = Maintenance::query()
            ->where('user_id', auth()->id())
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('address', 'ILIKE', "%{$search}%")
                       ->orWhere('neighborhood', 'ILIKE', "%{$search}%")
                       ->orWhere('city', 'ILIKE', "%{$search}%");
                });
            })
            ->when($start && $end, function ($q) use ($start, $end) {
                $q->whereBetween('created_at', [
                    Carbon::parse($start)->startOfDay(),
                    Carbon::parse($end)->endOfDay(),
                ]);
            })
            ->orderBy($orderField, $orderDir);

        $p = $query->paginate($take, ['*'], 'page', $page);

        Log::info($p->items()[0]);

        return response()->json([
            'items' => $p->items(),
            'data' => $p->items(),
            'itemCount' => $p->total(),
            'page' => $p->currentPage(),
            'pageCount' => $p->lastPage(),
            'take' => $p->perPage(),
        ]);
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
        return response()->json($maintenance);
    }

    public function update(MaintenanceRequest $request, Maintenance $maintenance): JsonResponse
    {
        Log::info($request->all());

        $updated = $this->service
            ->setMaintenance($maintenance)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function destroy(Maintenance $maintenance): JsonResponse
    {
        $this->service->delete($maintenance);
        return response()->json(null, 204);
    }
}
