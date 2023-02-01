<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    protected $table = "carts";

}
