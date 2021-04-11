<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscribe\StoreRequest;
use App\Http\Resources\UserResource;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function store(StoreRequest $request)
    {
        $subscriber = new Subscriber;
        $subscriber->user_id = $request->user_id;
        $subscriber->subscriber_id = Auth::id();

        $subscriber->save();

        return response(true, 201);
    }

    public function show(String $login)
    {
        $currentUser = User::where('login', $login)->first();

        return response()->json(new UserResource($currentUser), 200);
    }

    public function destroy($id): Response
    {
        $currentUser = User::find($id);
        $isSubscribed = $currentUser->subscribers->where('id', Auth::id())->first();
        $subscriber = Subscriber::where('user_id', $currentUser->id)->where('subscriber_id', Auth::id());

        if( isset($isSubscribed) ) {
            $subscriber->delete();
            return response('Good');
        }
        return response('Nothing');
    }
}
