<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Analytics extends Model
{
    use HasFactory;

    const TRANSACTION_TYPE_BOOSTERPACK = 'boosterpack';
    const TRANSACTION_TYPE_WALLET      = 'wallet';
    const TRANSACTION_TYPE_LIKE        = 'like';
    const TRANSACTION_TYPE_POST        = 'post';
    const TRANSACTION_TYPE_COMMENT     = 'comment';

    const ACTION_TYPE_BUY       = 'buy_boosterpack';
    const ACTION_TYPE_ADD_MONEY = 'add_money';
    const ACTION_TYPE_ADD_LIKE  = 'add_like';
    const ACTION_TYPE_LIKE      = 'like';

    protected $table = 'analytics';

    protected $fillable = ['user_id', 'object', 'action', 'object_id', 'amount', 'time_created', 'time_updated'];

    public $timestamps = false;

    protected $dates = ['time_created', 'time_updated'];

    /**
     * @return void
     */
    protected static function boot(){
        parent::boot();

        self::creating(function ($model) {
            $model->user_id = Auth::id();
            $model->time_created = Carbon::now();
            $model->time_updated = Carbon::now();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
