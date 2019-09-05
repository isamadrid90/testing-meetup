<?php

namespace Test;

use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserNotifier;
use DoublesMeetup\UserRepository;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Test\Dummy\UserRepositoryDummy;
use Test\Stub\UsernameValidatorValidStub;

class UserCreatorUsingMockTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValid()
    {
        $username          = 'username';
        $plainPassword     = 'password';
        $email             = 'email@email.com';

        $userRepository    = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorValidStub();
        $userNotifier      = new UserNotifierMock();

        $userCreator = new UserCreator($usernameValidator, $userRepository, $userNotifier);
        $createdUser = $userCreator->create($username, $plainPassword, $email);

        $this->assertEquals(User::create($username, $plainPassword, $email), $createdUser);
        $this->assertTrue($userNotifier->verify());
    }

    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValidWithProphecy()
    {
        $userRepository    = $this->prophesize(UserRepository::class);
        $userNotifier      = $this->prophesize(UserNotifier::class);
        $usernameValidator = $this->prophesize(UsernameValidator::class);
        $usernameValidator->validate(Argument::any())->willReturn(true);
        $username          = 'username';
        $plainPassword     = 'password';
        $email             = 'email@email.com';
        $userNotifier->sendWelcomeMessage($email)->shouldBeCalled();

        $userCreator = new UserCreator($usernameValidator->reveal(), $userRepository->reveal(), $userNotifier->reveal());
        $createdUser = $userCreator->create($username, $plainPassword, $email);

        $this->assertEquals(User::create($username, $plainPassword, $email), $createdUser);
    }
}