<?php

namespace Test\Mock;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UsernameValidatorValidMock implements UsernameValidator
{

    private $validateWasCalled = false;

    public function validate(string $username): bool
    {
        $this->validateWasCalled = true;
        return true;
    }

    public function verify(): bool
    {
        return $this->validateWasCalled;
    }
}