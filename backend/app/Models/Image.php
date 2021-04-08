<?php

namespace App\Models;

use Carbon\Carbon;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Image extends Model
{
    use HasFactory;

    public static function saveForUser (\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile)
    {
        $image = new Image();
        $date = Carbon::now()->format('Y-m-d');

        $image->name = $imageFile->getClientOriginalName();
        $image->size = $imageFile->getSize();
        $image->mime_type = $imageFile->getClientMimeType();
        $image->extension = $imageFile->getExtension();
        $image->user_id = Auth::id();
        $image->path = $imageFile->store('/'.Auth::user()->login.'/'.$date, "public");

        $image->save();

        return $image;
    }
}
