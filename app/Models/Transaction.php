<?php

namespace App\Models;

use App\Models\User;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function detail()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }
    protected $table = "transactions";

}
