<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const LIKE = 1, DISLIKE = 2;

    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reactionable(){
        return $this->morphTo();
    }
}
