<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Pole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function cards(Request $request): JsonResponse
    {
        $userId = auth()->id();

        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();

        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfDay();

        $maintenancesToday = Maintenance::where('user_id', $userId)
            ->whereBetween('created_at', [$todayStart, $todayEnd])
            ->count();

        $maintenancesMonth = Maintenance::where('user_id', $userId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $polesMonth = Pole::where('user_id', $userId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        return response()->json([
            'leadsToday' => $maintenancesToday,
            'monthlyRevenue' => $maintenancesMonth,
            'salesToday' => $polesMonth,
        ]);
    }
}
