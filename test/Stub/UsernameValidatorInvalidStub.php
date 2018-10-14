<?php

namespace Test\Stub;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UsernameValidatorInvalidStub implements UsernameValidator
{

    public function __construct(UserRepository $repository)
    {
        // nothing to do here
    }

    public function validate(string $username): bool
    {
        return false;
    }
}