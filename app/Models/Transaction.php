<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $primaryKey = "uuid";
    protected $guarded = [];

    public $incrementing = false;
    
    protected $casts = [
        'uuid' => 'string',
    ];

    // public function inquiry()
    // {
    //     return $this->hasOne(Inquiry::class, 'uuid');
    // }

    // public function transaction()
    // {
    //     return $this->belongsTo(Transaction::class, 'transaction_uuid');
    // }
}
