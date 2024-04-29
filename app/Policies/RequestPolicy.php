<?php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return in_array($user->role, ['administrator', 'secreatary', 'notary']);
    }
}