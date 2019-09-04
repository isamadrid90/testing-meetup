<?php

namespace Test\Stub;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UsernameValidatorValidStub extends UsernameValidator
{
    public function validate(string $username): bool
    {
        return true;
    }
}