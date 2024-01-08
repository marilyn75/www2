<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Carbon::setLocale('ko'); // 한국어 로케일 사용
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Blueprint::macro('userstamps', function(){
            $this->unsignedBigInteger('created_user_id')->nullable();
            $this->string('created_ip',20)->nullable();
            $this->unsignedBigInteger('updated_user_id')->nullable();
            $this->string('updated_ip',20)->nullable();
            $this->unsignedBigInteger('deleted_user_id')->nullable();
            $this->string('deleted_ip',20)->nullable();
        });
    }
}
