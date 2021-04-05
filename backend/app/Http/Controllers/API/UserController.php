<?php


namespace App\Http\Controllers\API;

use App\Http\Requests\Subscribe\StoreRequest;
use App\Http\Resources\UserResource;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function index(): JsonResponse
    {
        return response()->json(User::all(), 200);
    }

    public function store(StoreRequest $request)
    {
//        $request->validate();
//
//        $subscriber = new Subscriber;
//        $subscriber->user_id = $request->user_id;
//        $subscriber->subscriber_id = Auth::id();
//        $subscriber->save();
        return "Good";
    }

    public function show(String $login): JsonResponse
    {
        if (Auth::check()) {
            $currentUser = User::where('login', $login)->get();
            $subscribed =  $currentUser[0]->subscribers->where('id', Auth::id());
            $subscribe = false;

            if(isset($subscribed[1])){
                $subscribe = true;
            }

            return response()->json([
                'user' => new UserResource($currentUser),
                'subscribed' => $subscribe
            ], 200);
        }
    }

    public function destroy($id)
    {
        $currentUser = User::find($id); // Юзер на которого подписан
        $isSubscribed = $currentUser->subscribers->where('id', Auth::id());
        $subscriber = Subscriber::where('user_id', $currentUser->id)->where('subscriber_id', Auth::id());

        if(isset($isSubscribed[1])) {
            $subscriber->delete();
            return 'Good';
        }else {
            return 'Nothing';
        }
    }
}
