<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function item()
    {
        return $this->hasMany(Item::class, 'category_id', 'id');
    }
    protected $table = "categories";

}
