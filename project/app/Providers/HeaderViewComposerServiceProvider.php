<?php

namespace App\Providers;

use App\Models\Alarm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HeaderViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('*', function ($view) {
        //     // 유저 알람 정보 획득
        //     $user_id = Auth::user()->user_id;
        //     $alarm = Alarm::where('user_id', $user_id)
        //         ->where('alarm_flg', '0')
        //         ->get();

        //     // 뷰에 데이터 전달
        //     $view->with('alarmData', $alarm[0]);
        // });
    }
}
