<?php

namespace App\Policies;

use App\Models\User;

class ArticlePolicy
{

    public function create(User $user)
    {
        return $user->email_verified_at !== null;
    }
}
