<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function index (Request $request)
    {
//        return response()->json($request);
        return Inertia::render('Room', [
            'chat' => $request->chat
        ]);
    }
}
