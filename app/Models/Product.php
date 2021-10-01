<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    function category(){
        return $this->belgonsTo(Category::class);
    }

    function supplier(){
        return $this->belgonsTo(Supplier::class);
    }

    function tags(){
        return $this->belgonsToMany(Tag::class);
    }
}
