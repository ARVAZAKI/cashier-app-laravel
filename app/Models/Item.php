<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'item_id', 'id');
    }
    public function transaction()
    {
        return $this->hasManyThrough(Transaction::class, TransactionDetail::class);
    }

    protected $table = "items";
}
