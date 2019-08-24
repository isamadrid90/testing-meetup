<?php


namespace Test;


use DoublesMeetup\UserNotifier;

final class UserNotifierMock implements UserNotifier
{
    private $timesCalled = 0;
    private $correctEmail = false;

    public function sendWelcomeMessage(string $email): void
    {
        $this->timesCalled++;
        if ('email@email.com' === $email)
        {
            $this->correctEmail = true;
        }
    }

    public function verify(): bool
    {
        return $this->correctEmail && (1 === $this->timesCalled);
    }
}