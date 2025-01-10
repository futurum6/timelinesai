<?php

namespace Futurum\TimelinesAI;

use Illuminate\Support\ServiceProvider;

class TimelinesAIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TimelinesAI::class, function ($app) {
            $apiKey = config('services.timelines.ai_key');
            return new TimelinesAI($apiKey);
        });
    }

    public function boot()
    {
        //
    }
}
