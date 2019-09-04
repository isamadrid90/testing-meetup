<?php

declare(strict_types = 1);

namespace DoublesMeetup;

final class UsernameInvalid extends \Exception
{
    private function __construct(string $username)
    {
        parent::__construct(sprintf('Invalid username: %s', $username));
    }

    public static function withUsername(string $username) :self
    {
        return new self($username);
    }
}
