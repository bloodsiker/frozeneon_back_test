<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    protected $fillable = ['user_id', 'assign_id', 'reply_id', 'text', 'likes', 'time_created', 'time_updated'];

    public $timestamps = false;

    protected $attributes = [
        'likes' => 0
    ];

    protected $dates = ['time_created', 'time_updated'];

    protected static function boot(){
        parent::boot();

        self::creating(function ($model) {
            $model->user_id = Auth::id();
            $model->time_created = Carbon::now();
            $model->time_updated = Carbon::now();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply()
    {
        return $this->hasMany(__CLASS__, 'reply_id', 'id');
    }

    public function addLike()
    {
        $this->increment('likes', 1);

        return $this;
    }
}
