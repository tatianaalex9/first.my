<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'path'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getUserPhoto(): Collection
    {
        return Photo::where('user_id', Auth::user()->id)->get();
    }

    public static function getUserPhotoByPhotoId(int $photoId): Photo
    {
        return Photo::where('id', $photoId)->where('user_id', Auth::user()->id)->firstOrFail();
    }
}
