<?php

namespace DoublesMeetup;


class UsernameValidator
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validate(string $username): bool
    {
        return $this->containsOnlyLettersAndNumbers($username) && $this->notAlreadyUsed($username);
    }

    private function containsOnlyLettersAndNumbers(string $username)
    {
        return 0 === preg_match('/[^\w\d]/', $username);
    }

    private function notAlreadyUsed(string $username): bool
    {
        return null === $this->userRepository->findByUsername($username);
    }
}