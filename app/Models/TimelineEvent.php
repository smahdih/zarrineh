<?php

namespace App\Models;

use App\Enums\TimelineEnum;
use App\Models\User;
use Carbon\Carbon;

class TimelineEvent
{
    public TimelineEnum|string $type;
    public string $description;
    public ?int $user_id;
    public Carbon $datetime;

    protected ?User $user = null;
    protected bool $userLoaded = false;

    public function __construct(array $data)
    {
        $this->type = $this->resolveType($data['type'] ?? 'unknown');
        $this->description = $data['description'] ?? '';
        $this->user_id = $data['user_id'] ?? null;
        $this->datetime = Carbon::parse($data['datetime'] ?? now());
    }

    protected function resolveType(
        TimelineEnum|string $type,
    ): TimelineEnum|string {
        if ($type instanceof TimelineEnum) {
            return $type;
        }

        $enum = TimelineEnum::tryFrom($type);

        return $enum ?? $type;
    }

    /**
     * گرفتن instance Enum (در صورت موجود بودن)
     */
    public function enum(): ?TimelineEnum
    {
        return $this->type instanceof TimelineEnum
            ? $this->type
            : TimelineEnum::tryFrom($this->type);
    }

    /**
     * ترجمه فارسی نوع رویداد
     */
    public function typeLabel(): ?string
    {
        return $this->enum()?->label();
    }

    /**
     * توضیح پیش‌فرض از Enum
     */
    public function defaultDescription(): ?string
    {
        return $this->enum()?->defaultDescription();
    }

    /**
     * گرفتن کاربر مسبب (lazy load)
     */
    public function user(): ?User
    {
        if ($this->userLoaded) {
            return $this->user;
        }

        if (!$this->user_id) {
            $this->userLoaded = true;
            return null;
        }

        $this->user = User::find($this->user_id);
        $this->userLoaded = true;

        return $this->user;
    }

    public function __get($key)
    {
        return match ($key) {
            'user' => $this->user(),
            'type_label' => $this->typeLabel(),
            'default_description' => $this->defaultDescription(),
            default => $this->{$key} ?? null,
        };
    }
}
