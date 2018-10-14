<?php

namespace DoublesMeetup;


interface UsernameValidator
{
    public function __construct(UserRepository $repository);
    public function validate(string $username): bool;
}