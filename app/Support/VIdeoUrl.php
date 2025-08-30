<?php

namespace App\Support;

class VideoUrl
{
    public const YOUTUBE = 1;
    public const VIMEO   = 2;

    /**
     * Recibe una URL y devuelve:
     * ['platform_id' => 1|2, 'video_id' => '...'] o null si no coincide.
     */
    public static function parse(string $url): ?array
    {
        $url = trim($url);

        // Normalizamos host
        $host = parse_url($url, PHP_URL_HOST) ?? '';
        $host = strtolower(preg_replace('/^www\./', '', $host));

        // ======= YOUTUBE =======
        if (in_array($host, ['youtube.com', 'youtu.be', 'm.youtube.com'])) {
            // 1) youtu.be/<id>
            if ($host === 'youtu.be') {
                $path = trim(parse_url($url, PHP_URL_PATH), '/');
                $id = self::onlyVideoId($path);
                return $id ? ['platform_id' => self::YOUTUBE, 'video_id' => $id] : null;
            }

            // 2) youtube.com/watch?v=<id>
            parse_str(parse_url($url, PHP_URL_QUERY) ?? '', $q);
            if (!empty($q['v']) && self::isYoutubeId($q['v'])) {
                return ['platform_id' => self::YOUTUBE, 'video_id' => $q['v']];
            }

            // 3) /embed/<id>, /v/<id>, /shorts/<id>
            $path = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');
            $parts = explode('/', $path);
            $idx = array_search('embed', $parts, true);
            if ($idx !== false && isset($parts[$idx+1]) && self::isYoutubeId($parts[$idx+1])) {
                return ['platform_id' => self::YOUTUBE, 'video_id' => $parts[$idx+1]];
            }
            $idx = array_search('v', $parts, true);
            if ($idx !== false && isset($parts[$idx+1]) && self::isYoutubeId($parts[$idx+1])) {
                return ['platform_id' => self::YOUTUBE, 'video_id' => $parts[$idx+1]];
            }
            $idx = array_search('shorts', $parts, true);
            if ($idx !== false && isset($parts[$idx+1]) && self::isYoutubeId($parts[$idx+1])) {
                return ['platform_id' => self::YOUTUBE, 'video_id' => $parts[$idx+1]];
            }
        }

        // ======= VIMEO =======
        if (in_array($host, ['vimeo.com', 'player.vimeo.com'])) {
            $path = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');
            $parts = explode('/', $path);

            // player.vimeo.com/video/<id>
            $idx = array_search('video', $parts, true);
            if ($idx !== false && isset($parts[$idx+1]) && ctype_digit($parts[$idx+1])) {
                return ['platform_id' => self::VIMEO, 'video_id' => $parts[$idx+1]];
            }

            // vimeo.com/<id> o vimeo.com/channels/.../<id>
            $last = end($parts);
            if ($last && ctype_digit($last)) {
                return ['platform_id' => self::VIMEO, 'video_id' => $last];
            }
        }

        return null;
    }

    public static function isYoutubeId(string $id): bool
    {
        return (bool) preg_match('/^[A-Za-z0-9_-]{11}$/', $id);
    }

    public static function embedUrl(int $platformId, string $videoId): string
    {
        return $platformId === self::YOUTUBE
            ? "https://www.youtube.com/embed/{$videoId}"
            : "https://player.vimeo.com/video/{$videoId}";
    }
}
