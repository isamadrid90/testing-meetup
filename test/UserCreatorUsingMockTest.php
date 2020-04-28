<?php

namespace Test;

use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use DoublesMeetup\UserNotifier;
use PHPUnit\Framework\TestCase;
use Test\Dummy\UserRepositoryDummy;
use Test\Stub\UsernameValidatorValidStub;

class UserCreatorUsingMockTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValid()
    {
        $userRepository    = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorValidStub($userRepository);
        $userNotifier      = new UserNotifierMock();
        $username          = 'username';
        $plainPassword     = 'password';
        $email             = 'email@email.com';

        $userCreator = new UserCreator($usernameValidator, $userRepository, $userNotifier);
        $createdUser = $userCreator->create($username, $plainPassword, $email);

        $this->assertEquals(new User($username, $plainPassword, $email), $createdUser);
        $this->assertTrue($userNotifier->verify());
    }

    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValidWithProphecy()
    {
        $userRepository    = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorValidStub($userRepository);
        $userNotifier      = $this->prophesize(UserNotifier::class);
        $username          = 'username';
        $plainPassword     = 'password';
        $email             = 'email@email.com';
        $userNotifier->sendWelcomeMessage($email)->shouldBeCalled();

        $userCreator = new UserCreator($usernameValidator, $userRepository, $userNotifier->reveal());
        $createdUser = $userCreator->create($username, $plainPassword, $email);

        $this->assertEquals(new User($username, $plainPassword, $email), $createdUser);
    }
}