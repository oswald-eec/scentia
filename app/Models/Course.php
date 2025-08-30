<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title', 'description', 'price', 'hotmart_id', 'instructor_id'
    // ];

    protected $guarded = ['id','status'];
    protected $withCount = ['students','reviews'];

    protected $casts = [
        'average_rating' => 'float',
        'students_count' => 'integer',
    ];

    const BORRADOR = 1;
    const REVISION = 2;
    const PUBLICADO = 3;

    public function getRatingAttribute(){
        if($this->reviews_count){
            return round($this->reviews()->avg('rating'),2);
        } else{
            return 5;
        }
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    //Query Scopes
    public function scopeCategory($query, $category_id){
        if($category_id){
            return $query->where('category_id',$category_id);
        }
    }
    
    public function scopeLevel($query, $level_id){
        if($level_id){
            return $query->where('level_id',$level_id);
        }
    }

    /**
     * Scope para obtener los cursos más populares.
     */
    public function scopePopular($query)
    {
        return $query->withCount('reviews')
                    ->orderBy('reviews_count', 'desc')
                    ->where('status', self::PUBLICADO);
    }

    /**
     * Scope para obtener los cursos más comprados.
     */
    public function scopeMostPurchased($query)
    {
        return $query->withCount('students')
                    ->orderBy('students_count', 'desc')
                    ->where('status', self::PUBLICADO);
    }

    /**
     * Scope para obtener los últimos cursos agregados.
     */
    public function scopeLatestAdded($query)
    {
        return $query->latest('id')->where('status', self::PUBLICADO);
    }

    //Relacion uno a muchos
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function requirements(){
        return $this->hasMany(Requirement::class);
    }
    
    public function goals(){
        return $this->hasMany(Goal::class);
    }

    public function audiences(){
        return $this->hasMany(Audience::class);
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }

    //Relacion uno a muchos inversa
    public function teacher(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function price(){
        return $this->belongsTo(Price::class);
    }

    //Relacion muchos a muchos
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
                    // ->withPivot('purchased_at', 'price_paid')
                    ->withTimestamps();
    }


    //Relacion uno a uno poliformica
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function lessons(){
        return $this->hasManyThrough(Lesson::class,Section::class);
    }

    // Relación muchos a muchos con detalles adicionales (pivot table)
    public function buyers()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('purchased_at', 'price_paid')
                    ->withTimestamps();
    }

    // Relación con las compras
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
