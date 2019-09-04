<?php

namespace Test;

use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use DoublesMeetup\UsernameInvalid;
use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserNotifier;
use DoublesMeetup\UserRepository;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Test\Dummy\UserRepositoryDummy;
use Test\Stub\UsernameValidatorInvalidStub;
use Test\Stub\UsernameValidatorValidStub;

class UserCreatorTest extends TestCase
{

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUsernameInvalid()
    {
        $this->expectException(UsernameInvalid::class);

        $userRepository    = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorInvalidStub();
        $userNotifier      = new UserNotifierDummy();
        $userCreator       = new UserCreator($usernameValidator, $userRepository, $userNotifier);

        $userCreator->create('username', 'password', 'email@email.com');
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUsernameInvalidWithProphecy()
    {
        $this->expectException(UsernameInvalid::class);

        $userRepository    = $this->prophesize(UserRepository::class);
        $userNotifier      = $this->prophesize(UserNotifier::class);
        $usernameValidator = $this->prophesize(UsernameValidator::class);
        $usernameValidator->validate(Argument::any())->willReturn(false);

        $userCreator = new UserCreator(
            $usernameValidator->reveal(),
            $userRepository->reveal(),
            $userNotifier->reveal()
        );
        $userCreator->create('username', 'password', 'email@email.com');
    }

    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValid()
    {
        $userRepository    = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorValidStub();
        $userNotifier      = new UserNotifierDummy();
        $username          = 'username';
        $plainPassword     = 'password';
        $email             = 'email@email.com';

        $userCreator = new UserCreator($usernameValidator, $userRepository, $userNotifier);
        $createdUser = $userCreator->create($username, $plainPassword, $email);

        $this->assertEquals(new User($username, $plainPassword, $email), $createdUser);
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

        $userCreator = new UserCreator(
            $usernameValidator->reveal(),
            $userRepository->reveal(),
            $userNotifier->reveal()
        );
        $createdUser = $userCreator->create($username, $plainPassword, $email);

        $this->assertEquals(new User($username, $plainPassword, $email), $createdUser);
    }


}