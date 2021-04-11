<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\RoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Resources\MessagesResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where('chat_id', $request->chat)->get();

        return Inertia::render('Room', [
            'chat' => $request->chat,
            'messages' => MessagesResource::collection($messages),
        ]);
    }

    public function store(StoreRoomRequest $request): JsonResponse
    {
        $message = new Message();

        $message->title = $request->title;
        $message->user_id = Auth::id();
        $message->chat_id = $request->chat_id;

        $message->save();

        broadcast(new MessageSent(Auth::user(), $message))->toOthers();

        return response()->json(new MessagesResource($message));
    }
}
