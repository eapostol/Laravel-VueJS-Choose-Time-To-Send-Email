<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Message;
use Carbon\Carbon;
use App\Jobs\SendMailJob;
use App\User;
use App\Mail\NewArrivals;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to users';


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
     * @return mixed
     */
    public function handle()
    {
        // One hour is added to compensate for PHP being one hour faster
        // $now = date('Y-m-d H:i', strtotime(Carbon::now()->addHour()));
        // logger($now);
        $now = date('Y-m-d', strtotime(Carbon::now()->addHour()));
        logger($now);

        $messages = Message::get();

        if($messages !== null){
            // TODO: eja - check the date_string
            // Get All Messages where the date matches the current date;

            $sendMessages = static function ($message) {
                if($message->delivered == 'NO')
                {
                    $users = User::all();
                    foreach($users as $user) {
                        dispatch(new SendMailJob(
                                $user->email,
                                new NewArrivals($user, $message))
                        );
                    }
                    $message->delivered = 'YES';
                    $message->save();
                }
            };

            $messages->where('date_string', $now)->each($sendMessages);
        }
    }
}
