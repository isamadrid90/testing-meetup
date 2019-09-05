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
        $username      = 'username';
        $plainPassword = 'password';
        $email         = 'email@email.com';

        $userCreator = new UserCreatorLegacyWithValidUsernameTest();
        $createdUser = $userCreator->create('username', 'password', 'email@email.com');

        $this->assertEquals(User::create($username, $plainPassword, $email), $createdUser);
    }
}