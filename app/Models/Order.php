<?php

namespace App\Models;

use App\Traits\HasDatatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, HasDatatable;

    protected $fillable = [
        'customer_name',
        'customer_address',
        'customer_phone_number',
        'total_price',
        'status',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
