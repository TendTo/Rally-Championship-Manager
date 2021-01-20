<?php

namespace App\Policies;

use App\Models\Championship;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChampionshipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User         $user
     * @param  \App\Models\Championship $championship
     * @return mixed
     */
    public function view(User $user, Championship $championship)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

        /**
         * Determine whether the user can partecipate to the championship.
         *
         * @param  \App\Models\User         $user
         * @param  \App\Models\Championship $championship
         * @return mixed
         */
    public function participate(User $user, Championship $championship)
    {
        return $championship->participants()->where('user_id', '=', $user->id)->count() == 0;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User         $user
     * @param  \App\Models\Championship $championship
     * @return mixed
     */
    public function update(User $user, Championship $championship)
    {
        return $championship->participants()->where('user_id', '=', $user->id)->where('is_admin', '=', true)->count() == 1;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User         $user
     * @param  \App\Models\Championship $championship
     * @return mixed
     */
    public function delete(User $user, Championship $championship)
    {
        return $championship->participants()->where('user_id', '=', $user->id)->where('is_admin', '=', true)->count() == 1;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User         $user
     * @param  \App\Models\Championship $championship
     * @return mixed
     */
    public function restore(User $user, Championship $championship)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User         $user
     * @param  \App\Models\Championship $championship
     * @return mixed
     */
    public function forceDelete(User $user, Championship $championship)
    {
        //
    }
}
