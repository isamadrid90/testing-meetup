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
    public function shouldCreateNewUserWhenUsernameValidUsingMock()
    {
        $userRepository = new UserRepositoryDummy();
        $userValidator = new UsernameValidatorMock();
        $userCreator = new UserCreator($userValidator, $userRepository);

        $createdUser = $userCreator->create('username', 'password');

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals('username', $createdUser->username());
        $this->assertEquals(sha1('password'), $createdUser->encodedPassword());
        $this->assertTrue($userValidator->verify());
    }
}