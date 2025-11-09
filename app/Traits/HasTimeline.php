<?php

namespace App\Traits;

use App\Enums\TimelineEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait HasTimeline
{
    /**
     * Boot trait for model event hooks
     */
    public static function bootHasTimeline(): void
    {
        static::created(function (Model $model) {
            $model->addTimelineEvent(TimelineEnum::CREATED);
        });

        static::updated(function (Model $model) {
            $model->addTimelineEvent(TimelineEnum::UPDATED);
        });

        static::deleted(function (Model $model) {
            $model->addTimelineEvent(TimelineEnum::DELETED);
        });
    }

    /**
     * افزودن یک رویداد جدید به timeline مدل
     *
     * @param  TimelineEnum|string  $type
     * @param  string|null  $description
     * @param  int|null  $userId
     */
    public function addTimelineEvent(
        TimelineEnum|string $type,
        ?string $description = null,
        ?int $userId = null,
    ): void {
        $timeline = $this->timeline ?? [];

        // اگر نوع رشته‌ای بود، تلاش می‌کنیم به Enum تبدیل کنیم
        if (is_string($type) && enum_exists(TimelineEnum::class)) {
            $enum = TimelineEnum::tryFrom($type);
        } elseif ($type instanceof TimelineEnum) {
            $enum = $type;
        } else {
            $enum = null;
        }

        // تعیین توضیح نهایی
        $finalDescription =
            $description ?? ($enum?->defaultDescription() ?? 'رویداد ثبت شد.');

        // گرفتن شناسه کاربر (اگر کاربر وارد شده)
        $finalUserId = $userId ?? Auth::id();

        $timeline[] = [
            'type' => $enum?->value ?? (string) $type,
            'description' => $finalDescription,
            'user_id' => $finalUserId,
            'datetime' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $this->timeline = $timeline;

        // ذخیره بدون ایجاد حلقه‌ی بی‌نهایت (چون درون event هستیم)
        $this->saveQuietly();
    }

    /**
     * آخرین رویداد تایم‌لاین
     */
    public function latestTimelineEvent(): ?array
    {
        $timeline = $this->timeline ?? [];
        return !empty($timeline) ? end($timeline) : null;
    }

    /**
     * حذف تمام رویدادها
     */
    public function clearTimeline(): void
    {
        $this->timeline = [];
        $this->saveQuietly();
    }
}
