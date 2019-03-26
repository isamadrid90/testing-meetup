<?php

namespace DoublesMeetup;

use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;

class UsernameValidatorWorking implements UsernameValidator
{

    public function validate(string $username): bool
    {
        return true;
    }
}