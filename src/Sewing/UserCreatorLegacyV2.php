<?php

namespace DoublesMeetup\Sewing;

use DoublesMeetup\User;

class UserCreatorLegacyV2
{
    private $container;

    public function __construct($container = null)
    {
        $this->container = $container;
    }

    /**
     * @throws \Exception
     */
    public function create(string $username, string $password, string $email): User
    {
        if (false === $this->validateUsername($username)) {
            throw new \Exception(sprintf('Invalid username: %s', $username));
        }

        $user = User::create($username, $password, $email);

        $this->save($user);

        return $user;
    }

    protected function validateUsername(string $username): bool
    {
        if (null !== $this->container->get('repository.user')->findByUsername($username)) {
            return false;
        }

        return true;
    }

    protected function save(User $user): void
    {
        $this->container->get('repository.user')->save($user);
    }

}