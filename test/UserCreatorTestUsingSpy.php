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
    public function shouldCreateNewUserWhenUsernameValidUsingSpy()
    {
        $userRepository = new UserRepositoryDummy();
        $userValidator = new UsernameValidatorValidSpy($userRepository);
        $userCreator = new UserCreator($userValidator, $userRepository);

        $createdUser = $userCreator->create('username', 'password');

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals('username', $createdUser->username());
        $this->assertEquals(sha1('password'), $createdUser->encodedPassword());
        $this->assertTrue($userValidator->validateWasCalled);
    }
}