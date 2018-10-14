<?php

namespace Test\Fake;

use DoublesMeetup\User;
use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UserRepositoryInMemory implements UserRepository
{
    /** @var User[] */
    private $list = [];

    public function save(User $user): void
    {
        $this->list[$user->username()] = $user;
    }

    public function findByUsername(string $username): ?User
    {
        return $this->list[$username] ?? null;
    }
}