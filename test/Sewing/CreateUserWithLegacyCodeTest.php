<?php

namespace Test\Sewing;


use DoublesMeetup\User;
use PHPUnit\Framework\TestCase;

class CreateUserWithLegacyCodeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateUserWithLegacyCode()
    {
        $username       = 'username';
        $plainPassword  = 'password';
        $email          = 'email@email.com';

        $userCreator = new UserCreatorLegacyWithValidUsernameTest();
        $createdUser = $userCreator->create($username, $plainPassword, $email);

        $this->assertEquals(new User($username, $plainPassword, $email), $createdUser);
    }
}