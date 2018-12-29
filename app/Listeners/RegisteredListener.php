<?php

namespace App\Listeners;

use App\User;
use Illuminate\Auth\Event\Registered;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisteredListener
{
    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var User
     */
    private $eloquent;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer, User $eloquent)
    {
        $this->mailer = $mailer;
        $this->eloquent = $eloquent;
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $this->eloquent->findOrFail($event->user->getAuthIdentifier());
        $this->mailer->raw('会員登録が完了しました。', function ($message) use ($user){
            $message->subject('会員登録メール')->to($user->email);
        });
    }
}
