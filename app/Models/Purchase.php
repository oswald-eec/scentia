<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'hotmart_transaction_id',
        'status',
        'price_paid',
        'purchased_at'
    ];

    protected $dates = ['purchased_at'];

    // Relación con el usuario comprador
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el curso
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
