<?php

namespace App\Console\Commands;

use App\Jobs\SyncIranianHolidaysJob;
use Illuminate\Console\Command;

class SyncIranHolidays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holidays:sync
        {year : سال شمسی مثلا 1404}
        {--month= : ماه شمسی (اختیاری)}
        {--day= : روز شمسی (اختیاری)}
        {--all : همه روزها، حتی غیر تعطیل (اختیاری، پیشفرض فقط تعطیل‌ها)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Iranian holidays from pnldev API into the holidays table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $year = intval($this->argument('year'));
        $month = $this->option('month') ? intval($this->option('month')) : null;
        $day = $this->option('day') ? intval($this->option('day')) : null;
        $onlyHolidays = !$this->option('all');

        SyncIranianHolidaysJob::dispatch($year, $month, $day, $onlyHolidays);

        $this->info("Job for syncing holidays dispatched (year: $year" .
            ($month ? ", month: $month" : "") .
            ($day ? ", day: $day" : "") .
            ($onlyHolidays ? ", فقط تعطیلی‌ها" : ", همه روزها") .
            ")."
        );
    }
}