<?php

namespace App\Models;

use App\Support\VideoUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name', 
    //     'platform_id', 
    //     'url', 
    //     'section_id', 
    //     'iframe'
    // ];

    protected $guarded = ['id'];
    protected $appends = ['embed_url', 'duration_hms'];

    public function getEmbedUrlAttribute(): ?string
    {
        if (!$this->platform_id || !$this->video_id) return null;
        return VideoUrl::embedUrl($this->platform_id, $this->video_id);
    }

    public function getDurationHmsAttribute(): ?string
    {
        if (!isset($this->duration_seconds)) return $this->attributes['duration'] ?? null; // compat
        $sec = (int) $this->duration_seconds;
        $h = str_pad(intval($sec/3600), 2, '0', STR_PAD_LEFT);
        $m = str_pad(intval(($sec%3600)/60), 2, '0', STR_PAD_LEFT);
        $s = str_pad($sec%60, 2, '0', STR_PAD_LEFT);
        return "{$h}:{$m}:{$s}";
    }

    public function getCompleteAttribute(){
        return $this->users->contains(auth()->user()->id);
    }

    //Relacion uno a uno
    public function description(){
        return $this->hasOne(Description::class);
    }

    //Relacion uno a muchos inversa
    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function platform(){
        return $this->belongsTo(Platform::class);
    }

    //Relacion muchos a muchos
    public function users(){
        return $this->belongsToMany(User::class);
    }

    //Relacion uno a uno poliformica
    public function resource(){
        return $this->morphOne(Resource::class,'resourceable');
    }

    //Relacion uno a muchos polimorfica
    public function comments(){
        return $this->morphMany(Comment::class,'commentable')->whereNull('parent_id')->latest();
    }

    public function reactions(){
        return $this->morphMany(Reaction::class,'reactionable');
    }

}
