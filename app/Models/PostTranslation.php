<?php

namespace App\Models;

use App\Models\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTranslation extends Model
{
    use HasFactory, HasCompositePrimaryKey;

    protected $primaryKey = ['post_id', 'language_id'];
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'language_id',
        'title',
        'description',
        'content',
    ];


    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
