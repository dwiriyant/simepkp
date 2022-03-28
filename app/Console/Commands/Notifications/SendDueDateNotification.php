<?php

namespace App\Console\Commands\Notifications;

use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;
use App\Notifications\DueDateNotification;
use App\Models\User;

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
        $admins = User::whereHas('role', function ($query) {
            $query->where('id', 1);
        })->get();

        $user = ['name' => 'asdf'];

        Notification::send($admins, new DueDateNotification($user));
    }
}
