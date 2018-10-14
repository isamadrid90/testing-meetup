<?php

namespace DoublesMeetup;


class User
{
    private $username;
    private $encodedPassword;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->encodedPassword = sha1($password);
    }

    public static function create(string $username, string $password)
    {
        return new self($username, $password);
    }

    public function username(): string
    {
        return $this->username;
    }

    public function encodedPassword(): string
    {
        return $this->encodedPassword;
    }
}