<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pole;
use App\Services\PoleService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PoleRequest;
use Log;
use Illuminate\Http\Request;

class PoleController extends Controller
{
    public function __construct(private PoleService $service) {}

    public function index(Request $request): JsonResponse
    {
        $poles = Pole::query();

        $qrcode = $request->qrcode;

        if($qrcode){
            $pole = $poles->where('qrcode', $qrcode)
                ->first();

            Log::info('teste');
            Log::info($pole);

            return response()->json($pole);
        }else{
            Log::info('não tinha nadaaa');
        }
        
        $poles->get();

        return response()->json($poles);
    }

    public function store(PoleRequest $request): JsonResponse
    {
        $pole = $this->service
            ->create($request->validated())
            ->getObject();
    
        return response()->json($pole, 201);
    }

    public function update(PoleRequest $request, Pole $pole): JsonResponse
    {
        $updated = $this->service
            ->setPole($pole)
            ->update($request->validated())
            ->getObject();

        return response()->json($updated);
    }

    public function show(Pole $pole): JsonResponse
    {
        return response()->json(
            $pole->load([
                'type',
                'paving',
                'position',
                'networkType',
                'connectionType',
                'transformer',
                'access',
            ])
        );
    }

    public function destroy(Pole $pole): JsonResponse
    {
        $this->service->delete($pole);
        return response()->json(null, 204);
    }
}
