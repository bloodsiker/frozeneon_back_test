<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'personaname',
        'avatarfull',
        'rights',
        'likes_balance',
        'wallet_balance',
        'wallet_total_refilled',
        'wallet_total_withdrawn',
    ];

    protected $dates = ['time_created', 'time_updated'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $amount
     *
     * @return $this
     */
    public function writeOff($amount)
    {
        $this->decrement('likes_balance', $amount);

        return $this;
    }

    /**
     * @param float $sum
     *
     * @return $this
     */
    public function addBalance(float $sum)
    {
        $this->increment('wallet_balance', $sum);
        $this->increment('wallet_total_refilled', $sum);

        return $this;
    }
}
