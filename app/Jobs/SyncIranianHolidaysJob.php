<?php

namespace App\Jobs;

use App\Models\Core\Holiday;
use App\Services\IranianHolidayApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncIranianHolidaysJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new job instance.
     *
     * @param int $year
     * @param int|null $month
     * @param int|null $day
     * @param bool $onlyHolidays
     */
    public function __construct(
        public int $year,
        public ?int $month = null,
        public ?int $day = null,
        public bool $onlyHolidays = true,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $holidays = IranianHolidayApiService::fetchHolidays(
            $this->year,
            $this->month,
            $this->day,
            $this->onlyHolidays,
        );

        foreach ($holidays as $item) {
            Holiday::updateOrCreate(
                [
                    'date' => $item['date_gregorian'],
                ],
                [
                    'holiday' => $item['holiday'],
                    'event' => $item['event'] ?? null,
                    'type' => 'national',
                    'is_manual' => false,
                ],
            );
        }
    }
}
