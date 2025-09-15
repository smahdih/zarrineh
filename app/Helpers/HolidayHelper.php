<?php
namespace App\Helpers;

use App\Models\Core\Holiday;
use App\Models\Core\RecurringHoliday;
use Carbon\Carbon;

class HolidayHelper
{
    public static function isHoliday(Carbon $date, ?int $teamId = null): bool
    {
        if (self::isDateHoliday($date, $teamId)) {
            return true;
        }

        return self::hasMatchingRecurringHoliday($date, $teamId);
    }

    private static function isDateHoliday(Carbon $date, ?int $teamId): bool
    {
        return Holiday::where('date', $date->toDateString())
            ->when($teamId, fn($q) => self::applyTeamFilter($q, $teamId))
            ->exists();
    }

    private static function hasMatchingRecurringHoliday(Carbon $date, ?int $teamId): bool
    {
        $recurringHolidays = RecurringHoliday::query()
            ->where('enabled', true)
            ->when($teamId, fn($q) => self::applyTeamFilter($q, $teamId))
            ->get();

        foreach ($recurringHolidays as $rule) {
            if (self::matchesRule($rule->rule, $date)) {
                return true;
            }
        }

        return false;
    }

    private static function applyTeamFilter($query, ?int $teamId)
    {
        return $query->where(function ($q) use ($teamId) {
            $q->whereNull('team_id')->orWhere('team_id', $teamId);
        });
    }

    protected static function matchesRule(string $rule, Carbon $date): bool
    {
        if (str_starts_with($rule, 'weekly:')) {
            $day = strtolower($date->format('l')); // مثلاً 'friday'
            return $rule === 'weekly:' . $day;
        }

        if (str_starts_with($rule, 'yearly:')) {
            $pattern = substr($rule, strlen('yearly:')); // مثلاً '03-21'
            return $date->format('m-d') === $pattern;
        }

        if (str_starts_with($rule, 'monthly:')) {
            $day = (int) substr($rule, strlen('monthly:')); // مثلاً 01
            return (int) $date->format('d') === $day;
        }

        return false;
    }
}

