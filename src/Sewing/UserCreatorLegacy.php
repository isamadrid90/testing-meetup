<?php

namespace DoublesMeetup\Sewing;


use DoublesMeetup\User;

class UserCreatorLegacy
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }


    /**
     * @throws \Exception
     */
    public function create(string $username, string $password, string $email): User
    {
        if (null !== $this->container->get('repository.user')->findByUsername($username)) {
            throw new \Exception(sprintf('Invalid username: %s', $username));
        }

        $user = User::create($username, $password, $email);

        $this->container->get('repository.user')->save($user);

        return $user;
    }
}
