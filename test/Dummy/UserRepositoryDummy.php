<?php

namespace Test\Dummy;

use DoublesMeetup\User;
use DoublesMeetup\UserRepository;

class UserRepositoryDummy implements UserRepository
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