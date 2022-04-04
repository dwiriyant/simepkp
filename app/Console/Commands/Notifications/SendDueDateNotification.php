<?php

namespace App\Console\Commands\Notifications;

use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;
use App\Notifications\DueDateNotification;
use App\Models\Customer;

class SendDueDateNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notif:due_date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Due Date Notification';

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
        $customers = Customer::whereNotNull('tgl_jt')->get();
        foreach($customers as $customer) {
            if(date('N') == 7) {
                continue;
            } else if(date('N') == 6) {
                continue;
            }
            $customer_jt = $customer->tgl_jt;
            $day_jt = date('d', strtotime($customer_jt));
            $day_now = date('d');

            $end_day = date('t');
            if($day_jt > $end_day) {
                $customer_jt = date('Y-m-t', strtotime("-2 day", strtotime($customer_jt)));
            }

            $day_jt_N = date('N', strtotime(strtotime($customer_jt)));
            if($day_jt_N == 7) {
                $customer_jt = date('Y-m-d', strtotime("-2 day", strtotime($customer_jt)));
            } else if ($day_jt_N == 6) {
                $customer_jt = date('Y-m-d', strtotime("-1 day", strtotime($customer_jt)));
            }

            $day_jt_1 = date('d', strtotime("-1 day", strtotime($customer_jt)));
            $day_jt_2 = date('d', strtotime("-2 day", strtotime($customer_jt)));


            //now
            if($day_jt == $day_now) {
                Notification::route('mail', [
                    $customer->user->email => $customer->user->name,
                ])->notify(new DueDateNotification($customer));
            } else if ($day_jt_1 == $day_now) {
                Notification::route('mail', [
                    $customer->user->email => $customer->user->name,
                ])->notify(new DueDateNotification($customer));
            } else if ($day_jt_2 == $day_now) {
                Notification::route('mail', [
                    $customer->user->email => $customer->user->name,
                ])->notify(new DueDateNotification($customer));
            }

        }
    }
}
