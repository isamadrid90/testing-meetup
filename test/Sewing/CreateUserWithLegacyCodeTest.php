<?php

namespace Test\Sewing;


use DoublesMeetup\User;
use PHPUnit\Framework\TestCase;

class CreateUserWithLegacyCodeTest extends TestCase
{
    /**
     * @test
     */
    public function should_create_user_with_legacy_code()
    {
        $userCreator = new UserCreatorLegacyWithValidUsernameTest();

        $user = $userCreator->create('username', 'password', 'email@email.com');

        $this->assertEquals('username', $user->username());
        $this->assertEquals(sha1('password'), $user->password());
    }
}