<?php

namespace App\Models;

// use BenSampo\Enum\Traits\CastsEnums;
use App\Enums\HistoryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    // use CastsEnums;

    protected $casts = [
        'history_type' => HistoryType::class,
    ];
}
