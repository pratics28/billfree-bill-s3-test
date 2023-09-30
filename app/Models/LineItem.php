<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'quantity',
        'rate',
        'tax',
        'sub_total',
        'created_at',
        'updated_at'
    ];
}
