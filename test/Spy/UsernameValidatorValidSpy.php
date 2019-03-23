<?php

namespace Test\Spy;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UsernameValidatorValidSpy implements UsernameValidator
{

    public $validateWasCalled = false;

    public function validate(string $username): bool
    {
        $this->validateWasCalled = true;
        return true;
    }
}