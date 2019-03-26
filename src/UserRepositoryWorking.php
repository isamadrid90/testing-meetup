<?php

namespace DoublesMeetup;

use DoublesMeetup\User;
use DoublesMeetup\UserRepository;

class UserRepositoryWorking implements UserRepository
{

    public function save(User $user): void
    {
        return;
    }

    public function findByUsername(string $username): ?User
    {
        return null;
    }
}