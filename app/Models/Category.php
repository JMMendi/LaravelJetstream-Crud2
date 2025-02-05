<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['nombre', 'color'];

    // Relación 1:N con Posts
    public function posts() : HasMany {
        return $this->hasMany(Post::class);
    }
}
