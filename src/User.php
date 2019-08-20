<?php

namespace DoublesMeetup;


class User
{
    private $username;
    private $password;
    private $email;

    public function __construct(string $username, string $plainPassword, string $email)
    {
        $this->username = $username;
        $this->password = sha1($plainPassword);
        $this->email = $email;
    }

    public static function create(string $username, string $plainPassword, string $email)
    {
        return new self($username, $plainPassword, $email);
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function email(): string
    {
        return $this->email;
    }
}