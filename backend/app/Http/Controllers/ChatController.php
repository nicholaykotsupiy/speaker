<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\ChatUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        return response()->json(ChatResource::collection(Auth::user()->chats));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $chat = new Chat();

        $chat->name = $request->name;
        $chat->admin = Auth::id();

        $chat->save();

        $usersID = explode(',', $request->usersID);
        $chat->users()->attach(Auth::id());
        foreach ($usersID as $userID) {
            $chat->users()->attach($userID);
        }

        return response()->json($chat);
    }

    public function edit(Request $request)
    {
        if (! Gate::allows('edit-post', $request->id)) {
            redirect('/chats');
        }
        if($request->admin) {
            $chat = Chat::find($request->id);

            if($chat->name !== $request->name)
            {
                $chat->name = $request->name;
                $chat->save();
            }

            if($request->usersID !== '')
            {
                $chat_user = ChatUser::where('chat_id', $request->id)->get();
                foreach ($chat_user as $item)
                {
                    $item->delete();
                }

                $usersID = explode(',', $request->usersID);
                $chat->users()->attach(Auth::id());
                foreach ($usersID as $userID)
                {
                    $chat->users()->attach($userID);
                }
            }

            return response(new ChatResource($chat));
        }
    }

    public function exit($id)
    {
        Auth::user()->chats()->detach($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        if(isset($chat->messages)) {
            foreach ($chat->messages as $message) {
                $message->delete();
            }
        }

        $chat_user = ChatUser::where('chat_id', $chat->id)->get();
        if(isset($chat_user)) {
            foreach ($chat_user as $item) {
                $item->delete();
            }
        }

        $chat->delete();

        return response('ok');
    }
}
