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
    public function should_throw_exception_when_username_invalid()
    {
        $this->expectException(\Exception::class);

        $userRepository = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorInvalidStub($userRepository);
        $userCreator = new UserCreator($usernameValidator, $userRepository);

        $userCreator->create('username', 'password');
    }

    /**
     * @test
     */
    public function should_create_new_user_when_username_valid()
    {
        $userRepository = new UserRepositoryDummy();
        $usernameValidator = new UsernameValidatorValidStub($userRepository);
        $userCreator = new UserCreator($usernameValidator, $userRepository);
        $createdUser = $userCreator->create('username', 'password');

        $this->assertEquals('username', $createdUser->username());
        $this->assertEquals(sha1('password'), $createdUser->encodedPassword());
    }
}