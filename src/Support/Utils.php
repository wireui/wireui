<?php

namespace WireUi\Support;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * This class is a copy of Livewire's Utils class.
 * The purpose of this class is to serve static assets without requiring livewire installation.
 *
 * @see https://github.com/livewire/livewire/blob/d443bef7f75403976c30fbc68369336cfd14ef12/src/Drawer/Utils.php
 */
class Utils
{
    public static function pretendResponseIsFile(string $path, string $mimeType): Response|BinaryFileResponse
    {
        $expires = strtotime('+1 year');
        $lastModified = filemtime($path);
        $cacheControl = 'public, max-age=31536000';

        if (static::matchesCache($lastModified)) {
            return response()->make('', 304, [
                'Expires' => static::httpDate($expires),
                'Cache-Control' => $cacheControl,
            ]);
        }

        $headers = [
            'Content-Type' => "{$mimeType}; charset=utf-8",
            'Expires' => static::httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => static::httpDate($lastModified),
        ];

        if (str($path)->endsWith('.br')) {
            $headers['Content-Encoding'] = 'br';
        }

        return response()->file($path, $headers);
    }

    private static function matchesCache($lastModified)
    {
        $ifModifiedSince = $_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '';

        return @strtotime($ifModifiedSince) === $lastModified;
    }

    private static function httpDate($timestamp)
    {
        return sprintf('%s GMT', gmdate('D, d M Y H:i:s', $timestamp));
    }
}
