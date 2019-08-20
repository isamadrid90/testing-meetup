<?php


namespace Test;

use DoublesMeetup\UserNotifier;

final class UserNotifierSpy implements UserNotifier
{
    private $sendWelcomeMessageWasCalled = false;
    private $emailUsed;

    public function sendWelcomeMessage(string $email): void
    {
        $this->emailUsed=  $email;
        $this->sendWelcomeMessageWasCalled = true;
    }

    public function sendWelcomeMessageWasCalled(): bool
    {
        return $this->sendWelcomeMessageWasCalled;
    }

    public function emailUsed(): string
    {
        return $this->emailUsed;
    }
}