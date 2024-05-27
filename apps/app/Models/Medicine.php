<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'stock',
        'unit',
        'image',
        'price',
        'description',
        'expired_date',
    ];
    protected $table = 'medicines';
    public function carts() {
        return $this->hasMany('App\Models\Cart');
    }

    public function order_items() {
        return $this->hasMany('App\Models\OrderItem');
    }
}
