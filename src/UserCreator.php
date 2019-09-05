<?php

namespace DoublesMeetup;

final class UserCreator
{
    private $usernameValidator;
    private $userRepository;
    private $userNotifier;

    public function __construct(
        UsernameValidator $usernameValidator,
        UserRepository $userRepository,
        UserNotifier $userNotifier
    ) {
        $this->usernameValidator = $usernameValidator;
        $this->userRepository = $userRepository;
        $this->userNotifier = $userNotifier;
    }

    /**
     * @throws UsernameInvalid
     */
    public function create(string $username, string $password, string $email): User
    {
        if (false === $this->usernameValidator->validate($username)) {
            throw UsernameInvalid::withUsername($username);
        }

        $user = User::create($username, $password, $email);

        $this->userRepository->save($user);

        $this->userNotifier->sendWelcomeMessage($email);

        return $user;
    }
}