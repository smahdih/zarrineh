<?php

use Illuminate\Support\Facades\URL;

/** * Generate a temporary signed
      URL for a private file. * * @param string|null $path * @param int $minutes * @param string|null $default * @return
      string|null
*/

function private_file_url(
    ?string $path,
    int $minutes = 30,
    ?string $default = null,
): ?string {
    if ($path) {
        return URL::temporarySignedRoute(
            'storage.private',
            now()->addMinutes($minutes),
            ['path' => $path],
        );
    }

    return $default;
}
