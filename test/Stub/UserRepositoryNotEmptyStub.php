<?php


namespace Test\Stub;


use DoublesMeetup\User;
use DoublesMeetup\UserRepository;

class UserRepositoryNotEmptyStub implements UserRepository
{
    public function save(User $user): void
    {
        return;
    }

    public function findByUsername(string $username): ?User
    {
        return new User($username, 'password', 'email@email');
    }
}