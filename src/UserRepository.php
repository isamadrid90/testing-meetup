<?php

namespace DoublesMeetup;


interface UserRepository
{
    public function save(User $user): void;

    public function findByUsername(string $username): ?User;
}