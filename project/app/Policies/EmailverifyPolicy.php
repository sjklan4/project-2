<?php

namespace App\Policies;

use App\Models\UserInfo;
use App\Models\emailverify;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailverifyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(UserInfo $userInfo)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @param  \App\Models\emailverify  $emailverify
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserInfo $userInfo, emailverify $emailverify)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserInfo $userInfo)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @param  \App\Models\emailverify  $emailverify
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserInfo $userInfo, emailverify $emailverify)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @param  \App\Models\emailverify  $emailverify
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserInfo $userInfo, emailverify $emailverify)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @param  \App\Models\emailverify  $emailverify
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(UserInfo $userInfo, emailverify $emailverify)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @param  \App\Models\emailverify  $emailverify
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(UserInfo $userInfo, emailverify $emailverify)
    {
        //
    }
}
