<?php

namespace Test\Stub;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;
use Test\Dummy\UserRepositoryDummy;

class UsernameValidatorValidStub extends UsernameValidator
{
    public function validate(string $username): bool
    {
        return true;
    }
}