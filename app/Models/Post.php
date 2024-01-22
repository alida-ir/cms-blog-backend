<?php

namespace App\Models;


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory , Sluggable , SoftDeletes;
    protected $guarded;

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class , 'tag_post');
    }

    public function sluggable(): array
    {
        return [
            "slug" => [
                "source" => "title_en"
            ]
        ];
    }
}
