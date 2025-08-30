<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function commentable(){
        return $this->morphTo();
    }

    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relación de respuestas (self-referencing)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('user');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

    public function reactions(){
        return $this->morphMany(Reaction::class,'reactionable');
    }
}

