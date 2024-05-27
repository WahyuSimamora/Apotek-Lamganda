<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'medicine_id',
        'quantity',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function medicine() {
        return $this->belongsTo('App\Models\Medicine');
    }
}
