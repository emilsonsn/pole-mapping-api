<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\Pole;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'qrcode' => 'required|string',
        ]);

        $pole = Pole::where('qrcode', $request->qrcode)->first();

        if (! $pole) {
            return response()->json(null);
        }

        $ticket = Ticket::where('pole_id', $pole->id)
            ->where('status', 'open')
            ->latest()
            ->first();

        return response()->json($ticket);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'qrcode' => 'required|string|exists:poles,qrcode',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $pole = Pole::where('qrcode', $data['qrcode'])->first();

        $payload = [
            'pole_id' => $pole->id,
            'description' => $data['description'],
        ];

        if ($request->hasFile('image')) {
            $payload['image_path'] =
                $request->file('image')->store('tickets', 'public');
        }

        $ticket = Ticket::create($payload);

        return response()->json($ticket, 201);
    }
}
