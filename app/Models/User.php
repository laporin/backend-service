<?php

namespace App\Models;

use App\Traits\HasAgents;
use Doctrine\DBAL\Types\StringType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasAgents;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The team model that should be used by Jetstream.
     *
     * @var string
     */
    public static $teamModel = 'App\\Models\\Agent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function isAdmin() {
        return $this->name == 'admin';
    }

    // public function agents() {
    //     return $this->hasManyThrough(Agent::class, AgentUser::class);
    // }

    // public function allAgents() {
    //     return $this->agents()->get();
    // }

    // public function currentAgent()
    // {
    //     return $this->belongsTo(Agent::class);
    // }

    public static function admin() {
        return User::getByRole('admin');
    }

    public static function user() {
        return User::getByRole('user');
    }

    public static function getByRole(String $role) {
        return User::role($role)->first();
    }
}
