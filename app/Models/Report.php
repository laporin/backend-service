<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial',
        'user_id',
        'category_id',
        'detail',
        'address',
        'city',
        'subdistrict',
        'latitude',
        'longitude',
        'private',
    ];

    /**
     * Get all of the report's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
