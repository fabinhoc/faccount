<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject(Lang::get('email.emailVerify.subject'))
                ->line(Lang::get('email.emailVerify.line1'))
                ->action(Lang::get('email.emailVerify.action'), config('app.spa_url') . '/auth/verify?url=' . $url)
                ->view('emails.pages.verification')
            ;
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject(Lang::get('email.resetPassword.subject'))
                ->line(Lang::get('email.resetPassword.line1'))
                ->action(Lang::get('email.resetPassword.action'), config('app.spa_url'). "/auth/reset-password?token={$url}&email={$notifiable->email}")
                ->view('emails.pages.resetPassword')
            ;
        });
    }
}
