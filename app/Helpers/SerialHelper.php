<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SerialHelper
{
    /**
     * Generate a unique serial for given Eloquent model and optional prefix.
     *
     * @param  Model  $model
     * @param  string|null $prefix
     * @param  int $length  Length of random string part (default: 6)
     * @return string
     */
    public static function generate(
        Model $model,
        ?string $prefix = null,
        int $min = 10,
        int $max = 9999,
        int $length = 6,
        bool $string = false,
    ): string {
        $prefix = $prefix ?: '';
        do {
            $serial = $prefix;
            $serial .= $string
                ? strtoupper(Str::random($length))
                : random_int($min, $max);
        } while ($model->where('serial', $serial)->exists());
        return $serial;
    }
}
