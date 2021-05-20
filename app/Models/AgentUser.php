<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentUser extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id', 'agent_id', 'role'
    ];

    public function users() {
        $this->belongsTo(User::class);
    }

    public function agents() {
        $this->belongsTo(Agent::class);
    }
}
