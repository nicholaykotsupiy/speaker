<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscribeResource;
use App\Http\Resources\SubscribersResource;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function subscribe()
    {
        return response([
            'data' => SubscribeResource::collection(Auth::user()->subscribe),
            'subscribe_count' => Auth::user()->subscribe_count
        ], 200);
    }

    public function subscribers()
    {
        return response([
            'data' => SubscribersResource::collection(Auth::user()->subscribers),
            'subscribers_count' => Auth::user()->subscribers_count,
        ], 200);
    }
}
