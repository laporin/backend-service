<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * Get all of the report's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
