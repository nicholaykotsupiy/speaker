<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscribe\StoreRequest;
use App\Http\Resources\UserResource;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function store(StoreRequest $request)
    {
        $request->validate();

        $subscriber = new Subscriber;
        $subscriber->user_id = $request->user_id;
        $subscriber->subscriber_id = Auth::id();

        $subscriber->save();
    }

    public function destroy(User $user)
    {
        //
    }
}
