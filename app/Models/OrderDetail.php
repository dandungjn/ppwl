<?php

namespace App\Models;

use App\Traits\HasDatatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes, HasDatatable;

    protected $fillable = [
        'order_id',
        'furniture_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
