<?php

namespace Ewvlnet\Dropzone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'page_id', 'name', 'type', 'url'];


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($file) {
            Storage::disk('public')->delete($file->url);
        });
    }
}
