<?php

namespace Test;

use DoublesMeetup\UserNotifier;

class UserNotifierDummy implements UserNotifier
{
    public function sendWelcomeMessage(string $email): void
    {
        throw new \Exception('Function sendWelcomeMessage should NOT be called');
    }
}