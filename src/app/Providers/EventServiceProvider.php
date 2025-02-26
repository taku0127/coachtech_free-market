<?php

namespace App\Providers;

use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // // ログアウト時にメール認証を null にする
        Event::listen(Logout::class, function ($event) {
            if ($event->user) {
                // ログアウトしたユーザーのメール認証日付を null に設定
                $event->user->email_verified_at = null;
                $event->user->save();
            }
        });
    }
}
