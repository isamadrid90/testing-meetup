<?php
namespace Test;

use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
use Test\Dummy\UserRepositoryDummy;
use Test\Stub\UsernameValidatorValidStub;

class   UserCreatorTestUsingSpy extends TestCase
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

        $this->assertEquals(new User($username, $plainPassword, $email), $createdUser);
        $this->assertTrue($userNotifier->sendWelcomeMessageWasCalled());
        $this->assertEquals($email, $userNotifier->emailUsed());
    }
}