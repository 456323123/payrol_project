<?php

namespace App\Console\Commands;


use App\Models\Threshold;
use App\Models\Accumulate;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'WordOfTheDay:updateThreshold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating the value of accumulative threshold';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $htreshold = Threshold::get()->toArray();
        $count = Accumulate::get()->count();
        $currentThreshold = $htreshold[0]['amount'];
        if ($count == 0) {
            $startDate = '2021-12-25';
            $min = 13;
            $endDate = date('Y-m-d', strtotime($startDate . ' + ' . $min . ' days'));
            $addVal = new Accumulate();
            $addVal->payroll_no = $count += 1;
            $addVal->start_date = $startDate;
            $addVal->end_date = $endDate;
            $addVal->accumalative_payrol_value = $currentThreshold;
            $addVal->save();
        } else {
            $data = Accumulate::get()->last()->toArray();
            $startDate = $data['end_date'];
            $datedata = $data['end_date'];
            $lastThreshold = $data['accumalative_payrol_value'];
            $current = Date('Y-m-d');
            // dd($current, $datedata);
            $total_time_seconds = Carbon::parse($current)->diffInDays($datedata);
            $min = 1;
            $startDate = date('Y-m-d', strtotime($startDate . ' + ' . $min . ' days'));
            $date = 14;
            $endDate = date('Y-m-d', strtotime($startDate . ' + ' . $date . ' days'));

            //dd($total_time_seconds);
            //dd($total_time_seconds);
            if ($total_time_seconds == 14) {
                $addVal = new Accumulate();
                $addVal->payroll_no = $count += 1;
                $addVal->start_date = $startDate;
                $addVal->end_date = $endDate;
                $addVal->accumalative_payrol_value = $currentThreshold + $lastThreshold;
                $addVal->save();
            }
        }
    }
}
