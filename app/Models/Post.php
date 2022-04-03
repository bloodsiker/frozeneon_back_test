<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';

    protected $fillable = ['user_id', 'text', 'img', 'likes', 'time_created', 'time_updated'];

    public $timestamps = false;

    protected $dates = ['time_created', 'time_updated'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'assign_id', 'id');
    }

    public function getParentComments()
    {
        return $this->comments()->whereNull('reply_id')->get();
    }

    /**
     * @return $this
     */
    public function addLike()
    {
        $this->increment('likes');

        return $this;
    }
}
