<?php

namespace App\Policies;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParticipantPolicy
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
     * @param  \App\Models\User        $user
     * @param  \App\Models\Participant $participant
     * @return mixed
     */
    public function view(User $user, Participant $participant)
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
     * Determine whether the user can make the participant an admin.
     *
     * @param  \App\Models\User        $user
     * @param  \App\Models\Participant $participant
     * @return mixed
     */
    public function upgrade(User $user, Participant $participant)
    {
        //You are an admin
        if($participant->championship->participants()->where('is_admin', '=', true)->where('user_id', '=', $user->id)->count() == 1) {
            return $user->id != $participant->user->id && !$participant->is_admin;
        }
    }

    /**
     * Determine whether the user can make the participant an admin.
     *
     * @param  \App\Models\User        $user
     * @param  \App\Models\Participant $participant
     * @return mixed
     */
    public function downgrade(User $user, Participant $participant)
    {
        //You are an admin
        if($participant->championship->participants()->where('is_admin', '=', true)->where('user_id', '=', $user->id)->count() == 1) {
            return $user->id != $participant->user->id && $participant->is_admin;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User        $user
     * @param  \App\Models\Participant $participant
     * @return mixed
     */
    public function update(User $user, Participant $participant)
    {
        return $user->id == $participant->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User        $user
     * @param  \App\Models\Participant $participant
     * @return mixed
     */
    public function delete(User $user, Participant $participant)
    {
        //You are not the partecipant and you are not an admin in this championship
        if ($user->id != $participant->user->id
            && $participant->championship->participants()->where('is_admin', '=', true)->where('user_id', '=', $user->id)->count() == 0
        ) {
            return false;
        }

        if(!$participant->is_admin) {
            return true;
        }
        else {
            return  $participant->championship->participants()->where('is_admin', '=', true)->count() > 1;
        }
        //return $user->id == $participant->user->id && !$participant->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User        $user
     * @param  \App\Models\Participant $participant
     * @return mixed
     */
    public function restore(User $user, Participant $participant)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User        $user
     * @param  \App\Models\Participant $participant
     * @return mixed
     */
    public function forceDelete(User $user, Participant $participant)
    {
        //
    }
}
