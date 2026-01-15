<?php

namespace App\Models;

use App\Traits\HasDatatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Furniture extends Model
{
    use HasFactory, SoftDeletes, HasDatatable;
    
    protected $table = 'furniture'; // This line is already correct

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'image',
        'stock',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
