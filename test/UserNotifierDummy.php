<?php

namespace Test;

use DoublesMeetup\UserNotifier;

class UserNotifierDummy implements UserNotifier
{
    public function sendWelcomeMessage(string $email): void
    {
        return;
    }
}