<?php

namespace DoublesMeetup;


final class User
{
    private $username;
    private $password;
    private $email;

    public function __construct(string $username, string $password, string $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email    = $email;
    }

    public static function create(string $username, string $plainPassword, string $email)
    {
        return new self($username, sha1($plainPassword), $email);
    }

    public function username(): string
    {
        return $this->username;
    }
}