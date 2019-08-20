<?php


namespace DoublesMeetup;


interface UserNotifier
{
    public function sendWelcomeMessage(string $email): void;
}