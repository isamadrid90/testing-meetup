<?php
namespace Test;


use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
use Test\Fake\UserRepositoryInMemory;
use Test\Stub\UsernameValidatorValidStub;

class UserCreatorUsingFakeTest extends TestCase
{
    /** @test */
    public function shouldCreateNewUserWhenUsernameValidFake()
    {
        $userRepository = new UserRepositoryInMemory();
        $usernameValidator = new UsernameValidatorValidStub();
        $userNotifier = new UserNotifierDummy();
        $userCreator = new UserCreator($usernameValidator, $userRepository, $userNotifier);
        $userCreator->create('username', 'password', 'email@email.com');

        $createdUser = $userRepository->findByUsername('username');

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals('username', $createdUser->username());
        $this->assertEquals(sha1('password'), $createdUser->password());
    }
}