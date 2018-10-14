<?php

namespace DoublesMeetup;


class UserCreator
{
    private $usernameValidator;

    private $userRepository;

    public function __construct(
        UsernameValidator $usernameValidator,
        UserRepository $userRepository
    ) {
        $this->usernameValidator = $usernameValidator;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Exception
     */
    public function create(string $username, string $password): User
    {
        if (false === $this->usernameValidator->validate($username)) {
            throw new \Exception(sprintf('Invalid username: %s', $username));
        }

        $user = User::create($username, $password);

        $this->userRepository->save($user);

        return $user;
    }
}