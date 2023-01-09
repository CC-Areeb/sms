<?php

namespace CooperativeComputing\SMS;

use Illuminate\Support\ServiceProvider;


class SmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../stubs/config/sms.php' => config_path('sms.php'),
        ], 'CC-SMS');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class
            ]);
        }
    }

    public function provides()
    {
        return [Console\InstallCommand::class];
    }
}