<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reaction extends Model
{
    //
    use HasFactory;
    protected $table = 'reactions';
    protected $fillable = [
        'type',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments() : BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }


}
