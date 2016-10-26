<?php

namespace App\Policies;

use App\User;
use App\Card;
use Illuminate\Auth\Access\HandlesAuthorization;

class CardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the card.
     *
     * @param  App\User  $user
     * @param  App\Card  $card
     * @return mixed
     */
    public function view(User $user, Card $card)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create cards.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the card.
     *
     * @param  App\User  $user
     * @param  App\Card  $card
     * @return mixed
     */
    public function update(User $user, Card $card)
    {
        //
        return $user->id == $card->user_id;
    }

    /**
     * Determine whether the user can delete the card.
     *
     * @param  App\User  $user
     * @param  App\Card  $card
     * @return mixed
     */
    public function delete(User $user, Card $card)
    {
        //
        return $user->id == $card->user_id;
    }
}
