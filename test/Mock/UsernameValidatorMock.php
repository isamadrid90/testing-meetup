<?php

namespace Test\Mock;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UsernameValidatorMock implements UsernameValidator
{

    private $validateWasCalled = false;

    public function __construct(UserRepository $repository)
    {
        // nothing to do here
    }

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