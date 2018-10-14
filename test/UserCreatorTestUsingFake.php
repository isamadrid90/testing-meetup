<?php
namespace Test;


use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
use Test\Fake\UserRepositoryInMemory;
use Test\Stub\UsernameValidatorValidStub;

class UserCreatorTestUsingFake extends TestCase
{
    /**
     * @test
     */
    public function should_create_new_user_when_username_valid_fake()
    {
        $userRepository = new UserRepositoryInMemory();
        $usernameValidator = new UsernameValidatorValidStub($userRepository);
        $userCreator = new UserCreator($usernameValidator, $userRepository);
        $userCreator->create('username', 'password');

        $createdUser = $userRepository->findByUsername('username');

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals('username', $createdUser->username());
        $this->assertEquals(sha1('password'), $createdUser->encodedPassword());
    }
}