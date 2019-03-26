<?php
namespace Test;

use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
use Test\Dummy\UserRepositoryDummy;
use Test\Spy\UsernameValidatorValidSpy;

class UserCreatorTestUsingSpy extends TestCase
{
    /**
     * @test
     */
    public function should_create_new_user_when_username_valid_using_spy()
    {
        $userRepository = new UserRepositoryDummy();
        $userValidator = new UsernameValidatorValidSpy();
        $userCreator = new UserCreator($userValidator, $userRepository);

        $userCreator->create('username', 'password');

        $this->assertTrue($userValidator->validateWasCalled());
    }
}