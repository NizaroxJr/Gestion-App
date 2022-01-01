<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
