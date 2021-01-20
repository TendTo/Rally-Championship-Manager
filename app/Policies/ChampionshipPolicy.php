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
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User         $user
     * @param  \App\Models\Championship $championship
     * @return mixed
     */
    public function update(User $user, Championship $championship)
    {
        //TODO: could be better with an SQL Exists participant where ch_id = ch.id and is_admin = true and user_id = user.id
        foreach ($championship->participants as $participant) {
            if($participant->is_admin && $participant->user->id == $user->id) {
                return true;
            }
        }
        return false;
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
        foreach ($championship->participants as $participant) {
            if($participant->is_admin && $participant->user->id == $user->id) {
                return true;
            }
        }
        return false;
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
