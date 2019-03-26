<?php

namespace DoublesMeetup;


class User
{
    private $username;
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public static function create(string $username, string $plainPassword)
    {
        return new self($username, sha1($plainPassword));
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }
}