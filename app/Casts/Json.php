<?php

namespace App\Casts;

use App\Models\TimelineEvent;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use JsonSerializable;

class Json implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     * @throws \JsonException
     */
    public function get(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): mixed {
        if (is_null($value)) {
            return null;
        }

        $decoded = json_decode($value, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $value;
        }

        // اگر کلید timeline بود، آرایه را به TimelineEvent تبدیل کن
        if ($key === 'timeline' && is_array($decoded)) {
            return collect($decoded)
                ->map(fn($event) => new TimelineEvent($event))
                ->toArray();
        }

        return $decoded;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): mixed {
        if (is_null($value)) {
            return null;
        }

        // اگر خودش JsonSerializable بود، از json_encode مستقیم استفاده کن
        if ($value instanceof JsonSerializable) {
            return json_encode(
                $value,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
            );
        }

        // اگر خودش آرایه یا آبجکت معمولی بود
        if (is_array($value) || is_object($value)) {
            return json_encode(
                $value,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
            );
        }

        // اگر رشته JSON معتبر بود، همونو برگردون
        if (is_string($value)) {
            json_decode($value);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $value;
            }
        }

        // در غیر این صورت، تبدیل ساده به JSON رشته‌ای
        return json_encode((string) $value);
    }
}
