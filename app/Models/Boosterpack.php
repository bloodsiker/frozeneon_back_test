<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boosterpack extends Model
{
    use HasFactory;

    protected $table = 'boosterpack';

    protected $fillable = ['price', 'bank', 'us', 'time_created', 'time_updated'];

    public $timestamps = false;

    protected $dates = ['time_created', 'time_updated'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'boosterpack_info');
    }
}
