<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * Get the parent imageable model (history and report).
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
