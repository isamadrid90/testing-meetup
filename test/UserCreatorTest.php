<?php

namespace Test;

use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
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
        $this->expectException(\Exception::class);

        $userRepository = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorInvalidStub();
        $userCreator = new UserCreator($usernameValidator, $userRepository);

        $userCreator->create('username', 'password');
    }

    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValid()
    {
        $userRepository = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorValidStub();
        $userCreator = new UserCreator($usernameValidator, $userRepository);
        $createdUser = $userCreator->create('username', 'password');

        $this->assertEquals('username', $createdUser->username());
        $this->assertEquals(sha1('password'), $createdUser->password());
    }
}