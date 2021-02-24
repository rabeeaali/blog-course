<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * getImagePathAttribute
     *
     * @return void
     */
    public function getImagePathAttribute()
    {
        return asset("files/post_images/{$this->image}");
    }

    /**
     * tag relation
     *
     * @return void
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    /**
     * scopeSearch
     *
     * @param  mixed $query
     * @param  mixed $req
     * @return void
     */
    public function scopeSearch($query, $req)
    {
        $query->where(function ($query) use ($req) {
            $query->where('title', 'LIKE', '%' . $req . '%');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deleteOldImage()
    {
        Storage::delete("post_images/{$this->image}");
    }
}
