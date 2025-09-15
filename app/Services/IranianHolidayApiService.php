<?php
namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class IranianHolidayApiService
{
    /**
     * Fetches a list of holidays or events based on input parameters.
     *
     * @param int $year Solar year (required)
     * @param int|null $month Solar month (optional)
     * @param int|null $day Solar day (optional)
     * @param bool $onlyHolidays Only holidays? (default: true)
     * @return array
     */
    public static function fetchHolidays(int $year, ?int $month = null, ?int $day = null, bool $onlyHolidays = true): array
    {
        $params = [
            'year' => $year,
            'holiday' => $onlyHolidays ? 'true' : 'false'
        ];
        if ($month) $params['month'] = $month;
        if ($day) $params['day'] = $day;

        $response = Http::get('https://pnldev.com/api/calender', $params);

        if (!$response->successful() || empty($response['status']) || empty($response['result'])) {
            return [];
        }

        $result = $response['result'];

        if ($day && $month) {
            return [self::parseDay($result)];
        }

        if ($month) {
            return self::parseMonth($result, $onlyHolidays);
        }

        return self::parseYear($result, $onlyHolidays);
    }

    /**
     * Parses a single day's data into a standard array format.
     */
    private static function parseDay(array $dayData): array
    {
        $event = $dayData['event'] ?? [];
        $eventStr = is_array($event) ? implode(' - ', $event) : $event;

        return [
            'date_solar'     => sprintf('%04d-%02d-%02d', $dayData['solar']['year'], $dayData['solar']['month'], $dayData['solar']['day']),
            'date_gregorian' => sprintf('%04d-%02d-%02d', $dayData['gregorian']['year'], $dayData['gregorian']['month'], $dayData['gregorian']['day']),
            'holiday'        => (bool)($dayData['holiday'] ?? false),
            'event'          => $eventStr,
            'weekday_fa'     => $dayData['solar']['dayWeek'] ?? null,
            'weekday_en'     => $dayData['gregorian']['dayWeek'] ?? null,
            'month'          => $dayData['solar']['month'],
            'day'            => $dayData['solar']['day'],
            'year'           => $dayData['solar']['year'],
        ];
    }

    /**
     * Parses a month's data into an array of days.
     */
    private static function parseMonth(array $monthData, bool $onlyHolidays): array
    {
        $days = [];
        foreach ($monthData as $dayData) {
            if ($onlyHolidays && !($dayData['holiday'] ?? false)) continue;
            $days[] = self::parseDay($dayData);
        }
        return $days;
    }

    /**
     * Parses a year's data into an array of months.
     */
    private static function parseYear(array $yearData, bool $onlyHolidays): array
    {
        $holidays = [];
        foreach ($yearData as $monthData) {
            foreach ($monthData as $dayData) {
                if ($onlyHolidays && !($dayData['holiday'] ?? false)) continue;
                $holidays[] = self::parseDay($dayData);
            }
        }
        return $holidays;
    }
}
