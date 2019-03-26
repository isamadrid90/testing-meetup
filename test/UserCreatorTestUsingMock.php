<?php
namespace Test;


use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
use Test\Dummy\UserRepositoryDummy;
use Test\Mock\UsernameValidatorMock;

class UserCreatorTestUsingMock extends TestCase
{
    /**
     * @test
     */
    public function should_create_new_user_when_username_valid_using_mock()
    {
        $userRepository = new UserRepositoryDummy();
        $userValidator = new UsernameValidatorMock();
        $userCreator = new UserCreator($userValidator, $userRepository);

        $userCreator->create('username', 'password');

        $this->assertTrue($userValidator->verify());
    }
}