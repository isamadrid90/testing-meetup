<?php

namespace Test\Sewing;

use DoublesMeetup\User;
use DoublesMeetup\Sewing\UserCreatorLegacyV2;

class UserCreatorLegacyWithValidUsernameTest extends UserCreatorLegacyV2
{
    protected function validateUsername(string $username): bool
    {
        return true;
    }

    protected function save(User $user): void
    {
        return;
    }
}