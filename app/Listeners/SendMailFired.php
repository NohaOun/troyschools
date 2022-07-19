<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Mail;
class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $event->userId=1;
        $user = User::find($event->userId)->toArray();
        Mail::raw('Hi, welcome user',  function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Reorder Done');
        });
    }
}
