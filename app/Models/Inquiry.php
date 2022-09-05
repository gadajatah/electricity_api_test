<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = "uuid";
    protected $guarded = [];

    public $incrementing = false;
    
    protected $casts = [
        'uuid' => 'string',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_uuid');
    }
}
