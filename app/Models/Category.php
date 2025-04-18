<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //Relacion uno a muchos
    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user');
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
