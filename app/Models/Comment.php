<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'comments';
    protected $fillable = [
        'content',
    ];

    public function post(): BelongsTo {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function reactions(): HasMany {
        return $this->hasMany(Reaction::class);
    }
}
