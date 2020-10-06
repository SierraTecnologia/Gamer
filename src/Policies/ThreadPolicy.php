<?php

namespace Gamer\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use Gamer\Models\Features\Messenger\Thread;
use Gate;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Thread $thread)
    {
        return $thread->hasParticipant($user->id);
    }
}
