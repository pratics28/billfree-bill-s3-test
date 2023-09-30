<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'invoice_no',
        'due_date',
        'created_at',
        'updated_at'
    ];


    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from','id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to','id');
    }
}
