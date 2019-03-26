<?php

namespace Test\Spy;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UsernameValidatorValidSpy implements UsernameValidator
{

    private $validateWasCalled = false;

    public function validate(string $username): bool
    {
        $this->validateWasCalled = true;
        return true;
    }

    public function validateWasCalled(): bool
    {
        return $this->validateWasCalled;
    }
}