<?php

namespace App\Models;

use Faker\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Report extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function generateSerial()
    {
        $faker = Factory::create();
        $serialPrefix = 'ID';
        $serialSuffix = $faker->unique()->regexify('[A-Z]{5}[0-4]{3}');

        return $serialPrefix . $serialSuffix;
    }
}
