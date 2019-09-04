<?php

namespace Test\Dummy;

use DoublesMeetup\User;
use DoublesMeetup\UserRepository;

class UserRepositoryDummy implements UserRepository
{
    public function save(User $user): void
    {
        throw new \Exception('Function save should NOT be called');
    }

    public function findByUsername(string $username): ?User
    {
        return null;
    }
}