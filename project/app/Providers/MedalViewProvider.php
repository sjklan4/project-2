<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MedalViewProvider extends ServiceProvider
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
        View::composer('layout.userinfoNav', function ($view) {
            if(Auth::user()) {
                $style = DB::table('quest_statuses')
                ->join('quest_cates', 'quest_cates.quest_cate_id', 'quest_statuses.quest_cate_id')
                ->where('quest_statuses.user_id', Auth::user()->user_id)
                ->where('quest_statuses.rep_flg', '1')
                ->first();
                if($style) {
                    // 뷰에 데이터 전달
                    $view->with('medal', $style->quest_style);
                }
            }
        });
    }
}
