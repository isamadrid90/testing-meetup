<?php

namespace Test\Stub;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UsernameValidatorInvalidStub extends UsernameValidator
{
    public function validate(string $username): bool
    {
        return false;
    }
}