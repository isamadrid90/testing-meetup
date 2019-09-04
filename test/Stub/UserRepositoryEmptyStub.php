<?php


namespace Test\Stub;


use DoublesMeetup\User;
use DoublesMeetup\UserRepository;

class UserRepositoryEmptyStub implements UserRepository
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