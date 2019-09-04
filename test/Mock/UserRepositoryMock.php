<?php

declare(strict_types = 1);

namespace Test\Mock;

use DoublesMeetup\User;
use DoublesMeetup\UserRepository;

final class UserRepositoryMock implements UserRepository
{

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function findByUsername(string $username): ?User
    {
        // TODO: Implement findByUsername() method.
    }
}
