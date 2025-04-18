<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //Relacion uno a uno
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    //Relacion uno a muchos
    public function courses_dictated(){
        return $this->hasOne(Course::class);
    }

    public function courses_taught(){
        return $this->hasMany(Course::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function reactions(){
        return $this->hasMany(Reaction::class);
    }

    //Relacion muchos a muchos
    public function courses_enrolled(){
        return $this->belongsToMany(Course::class);
    }

    public function lessons(){
        return $this->belongsToMany(Lesson::class);
    }

    // Relación muchos a muchos con detalles adicionales (pivot table)
    public function coursesPurchased()
    {
        return $this->belongsToMany(Course::class)
                    ->withPivot('purchased_at', 'price_paid')
                    ->withTimestamps();
    }

    public function preferences()
    {
        return $this->belongsToMany(Category::class, 'category_user');
    }
}
