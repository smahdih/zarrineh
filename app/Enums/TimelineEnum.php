<?php

namespace App\Enums;

enum TimelineEnum: string
{
    case CREATED = 'created';
    case UPDATED = 'updated';
    case DELETED = 'deleted';
    case STATUS_CHANGED = 'status_changed';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function defaultDescription(): string
    {
        return match ($this) {
            self::CREATED => 'رکورد ایجاد شد.',
            self::UPDATED => 'رکورد ویرایش شد.',
            self::DELETED => 'رکورد حذف شد.',
            self::STATUS_CHANGED => 'وضعیت تغییر کرد.',
            self::APPROVED => 'درخواست تأیید شد.',
            self::REJECTED => 'درخواست رد شد.',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::CREATED => 'ایجاد',
            self::UPDATED => 'ویرایش',
            self::DELETED => 'حذف',
            self::STATUS_CHANGED => 'تغییر وضعیت',
            self::APPROVED => 'تأیید',
            self::REJECTED => 'رد شده',
        };
    }
}
