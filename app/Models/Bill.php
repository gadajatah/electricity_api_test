<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = "uuid";
    protected $guarded = [];

    public $incrementing = false;
    
    protected $casts = [
        'uuid' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'bill_uuid', 'uuid');
    }
}
