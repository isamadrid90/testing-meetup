<?php

namespace DoublesMeetup;


interface UsernameValidator
{
    public function validate(string $username): bool;
}