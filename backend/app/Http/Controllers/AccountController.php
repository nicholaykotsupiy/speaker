<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\SubscribeResource;
use App\Http\Resources\SubscribersResource;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function edit(UploadRequest $request)
    {
        if($request->hasFile('image')) {
            if(Auth::user()->image) {
                Storage::delete(Auth::user()->image->path);
                Auth::user()->image->delete();
            }

            $image = Image::saveForUser($request->file('image'));

            return response()->json($image);
        }

        return response()->json('File not exist');
    }

    public function showImage()
    {
        if(Auth::user()->image) {
            return response()->json(new ImageResource(Auth::user()->image));
        } else {
            return response()->json([]);
        }
    }

    public function userInfo()
    {
        return response()->json(Auth::user());
    }
}
