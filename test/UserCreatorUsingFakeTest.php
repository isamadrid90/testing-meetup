<?php

namespace Test;


use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
use Test\Fake\UserRepositoryInMemory;
use Test\Stub\UsernameValidatorValidStub;

class UserCreatorUsingFakeTest extends TestCase
{
    /** @test */
    public function shouldCreateNewUserWhenUsernameValidFake()
    {
        $userRepository    = new UserRepositoryInMemory();
        $usernameValidator = new UsernameValidatorValidStub();
        $userNotifier      = new UserNotifierDummy();
        $username          = 'username';
        $plainPassword     = 'password';
        $email             = 'email@email.com';

        $userCreator    = new UserCreator($usernameValidator, $userRepository, $userNotifier);
        $userCreator->create($username, $plainPassword, $email);

        $createdUser = $userRepository->findByUsername('username');

        $this->assertEquals(User::create($username, $plainPassword, $email), $createdUser);
    }
}