<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;
    protected $fillable = ['name', 'price'];
    protected $primaryKey = 'id';
    public function getCart(){
        return $this->hasMany(Cart::class);
    }
 }