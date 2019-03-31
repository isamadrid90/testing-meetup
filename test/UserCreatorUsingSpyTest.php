<?php
namespace Test;

use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
use Test\Dummy\UserRepositoryDummy;
use Test\Spy\UsernameValidatorValidSpy;

class UserCreatorUsingSpyTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValidUsingSpy()
    {
        $userRepository = new UserRepositoryDummy();
        $userValidator = new UsernameValidatorValidSpy();
        $userCreator = new UserCreator($userValidator, $userRepository);

        $userCreator->create('username', 'password');

        $this->assertTrue($userValidator->validateWasCalled());
    }
}