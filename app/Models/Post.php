<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return HasMany
     */
    public function postTranslations(): HasMany
    {
        return $this->hasMany(PostTranslation::class);
    }

    /**
     * @return HasManyThrough
     */
    public function tags(): HasManyThrough
    {
        return $this->hasManyThrough(Tag::class, PostTag::class);
    }
}
