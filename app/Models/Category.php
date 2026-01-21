<?php

namespace App\Models;

use App\Traits\HasDatatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, HasDatatable;

    protected $fillable = [
        'name',
    ];

    public function furniture()
    {
        return $this->hasMany(Furniture::class);
    }
}
