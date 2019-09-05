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

class UserCreatorUsingSpyTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValid()
    {
        $userRepository    = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorValidStub();
        $userNotifier      = new UserNotifierSpy();
        $username          = 'username';
        $plainPassword     = 'password';
        $email             = 'email@email.com';

        $userCreator = new UserCreator($usernameValidator, $userRepository, $userNotifier);
        $createdUser = $userCreator->create($username, $plainPassword, $email);

        $this->assertEquals(User::create($username, $plainPassword, $email), $createdUser);
        $this->assertTrue($userNotifier->sendWelcomeMessageWasCalled());
        $this->assertEquals($email, $userNotifier->emailUsed());
    }

    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValidWithProphecy()
    {
        $userRepository    = $this->prophesize(UserRepository::class);
        $usernameValidator = $this->prophesize(UsernameValidator::class);
        $usernameValidator->validate(Argument::any())->willReturn(true);
        $userNotifier      = $this->prophesize(UserNotifier::class);
        $username          = 'username';
        $plainPassword     = 'password';
        $email             = 'email@email.com';

        $userCreator = new UserCreator($usernameValidator->reveal(), $userRepository->reveal(), $userNotifier->reveal());
        $createdUser = $userCreator->create($username, $plainPassword, $email);

        $this->assertEquals(User::create($username, $plainPassword, $email), $createdUser);
        $userNotifier->sendWelcomeMessage($email)->shouldHaveBeenCalled();
    }
}