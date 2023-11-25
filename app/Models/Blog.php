<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * Get the blog that owns the comment.
     */
    public function blog()
    {
        return $this->belongsTo(User::class);
    }
}
