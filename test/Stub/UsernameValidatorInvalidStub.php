<?php

namespace Test\Stub;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UsernameValidatorInvalidStub implements UsernameValidator
{

    public function validate(string $username): bool
    {
        return false;
    }
}