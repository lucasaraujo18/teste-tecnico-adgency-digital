<?php 

namespace App\Modules\User\Repositories;

use App\Models\User;

class GetUserRepository {
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function findUserByEmail($email)
    {
        $user = $this->user->where('email', $email)->where('email_verified', 0)->first();

        return $user;
    }

    public function findUserById($id)
    {
        $user = $this->user->findOrFail($id);

        return $user;
    }
}