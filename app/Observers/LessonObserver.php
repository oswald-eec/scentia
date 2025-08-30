<?php

namespace App\Observers;

use App\Models\Lesson;
use App\Support\VideoUrl;
use Illuminate\Support\Facades\Storage;

class LessonObserver
{
    public function creating(Lesson $lesson)
    {
        $this->hydrateFromUrl($lesson);
        $this->normalizeDuration($lesson);
    }

    public function updating(Lesson $lesson)
    {
        $this->hydrateFromUrl($lesson);
        $this->normalizeDuration($lesson);
    }

    public function deleting(Lesson $lesson)
    {
        if ($lesson->resource) {
            Storage::delete($lesson->resource->url);
        }
    }

    protected function hydrateFromUrl(Lesson $lesson): void
    {
        if (!$lesson->url) return;

        $parsed = VideoUrl::parse($lesson->url);
        if ($parsed) {
            $lesson->platform_id = $parsed['platform_id']; // sobreescribe si no coincide
            $lesson->video_id    = $parsed['video_id'];
        } else {
            // Si la URL no es válida, provoca error de validación a nivel de request/Livewire (ver abajo)
            // Aquí podrías lanzar una excepción de dominio si prefieres.
        }
    }

    protected function normalizeDuration(Lesson $lesson): void
    {
        if ($lesson->duration && !$lesson->duration_seconds) {
            $lesson->duration_seconds = self::toSeconds($lesson->duration);
        }
    }

    public static function toSeconds(string $hms): ?int
    {
        if (!preg_match('/^\d{2}:\d{2}:\d{2}$/', $hms)) return null;
        [$h,$m,$s] = array_map('intval', explode(':', $hms));
        return $h*3600 + $m*60 + $s;
    }
}
// {
//     // Expresiones regulares optimizadas para YouTube y Vimeo
//     protected $youtubePattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([\w-]{11})$/';
//     protected $vimeoPattern = '/^(?:https?:\/\/)?(?:www\.)?vimeo\.com\/(\d+)$/';

//     public function creating(Lesson $lesson)
//     {
//         $this->setIframe($lesson);
//     }

//     public function updating(Lesson $lesson)
//     {
//         $this->setIframe($lesson);
//     }

//     public function deleting(Lesson $lesson)
//     {
//         if ($lesson->resource) {
//             Storage::delete($lesson->resource->url);
//         }
//     }

//     private function setIframe(Lesson $lesson)
//     {
//         $url = $lesson->url;
//         $platform_id = $lesson->platform_id;

//         if ($platform_id == 1) { // YouTube
//             if (preg_match($this->youtubePattern, $url, $matches)) {
//                 $videoId = $matches[1];
//                 $lesson->iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
//             }
//         } elseif ($platform_id == 2) { // Vimeo
//             if (preg_match($this->vimeoPattern, $url, $matches)) {
//                 $videoId = $matches[1];
//                 $lesson->iframe = '<iframe src="https://player.vimeo.com/video/' . $videoId . '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
//             }
//         }
//     }
// }

