<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MedalView extends ServiceProvider
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
        View::composer('*', function ($view) {
            if(Auth::user()) {
                $style = DB::table('quest_statuses')
                ->join('quest_cates', 'quest_cates.quest_cate_id', 'quest_statuses.quest_cate_id')
                ->where('quest_statuses.user_id', Auth::user()->user_id)
                ->where('quest_statuses.rep_flg', '1')
                ->first();
                var_dump($style);

                exit();
                // 칭호가 있을때
                if($style->count() > 0) {
                    // 뷰에 데이터 전달
                    $view->with('medal', $style->quest_style);
                }
            }
        });
    }
}
