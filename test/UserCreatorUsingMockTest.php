<?php
namespace Test;


use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
use Test\Dummy\UserRepositoryDummy;
use Test\Mock\UsernameValidatorInvalidMock;
use Test\Mock\UsernameValidatorValidMock;

class UserCreatorUsingMockTest extends TestCase
{
    /**
     * @test
     */
    public function shouldThrowExceptionWhenUsernameInvalidUsingMock()
    {
        $this->expectException(\Exception::class);

        $userRepository = new UserRepositoryDummy();
        $userValidator = new UsernameValidatorInvalidMock();
        $userCreator = new UserCreator($userValidator, $userRepository);

        $userCreator->create('username', 'password');

        $this->assertTrue($userValidator->verify());
    }

    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValidUsingMock()
    {
        $userRepository = new UserRepositoryDummy();
        $userValidator = new UsernameValidatorValidMock();
        $userCreator = new UserCreator($userValidator, $userRepository);

        $userCreator->create('username', 'password');

        $this->assertTrue($userValidator->verify());
    }
}