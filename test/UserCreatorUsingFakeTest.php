<?php
namespace Test;


use DoublesMeetup\User;
use DoublesMeetup\UserCreator;
use PHPUnit\Framework\TestCase;
use Test\Fake\UserRepositoryInMemory;
use Test\Stub\UsernameValidatorInvalidStub;
use Test\Stub\UsernameValidatorValidStub;

class UserCreatorUsingFakeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldThrowExceptionWhenUsernameInvalidUsingFake()
    {
        $this->expectException(\Exception::class);

        $userRepository = new UserRepositoryInMemory();
        $userValidator = new UsernameValidatorInvalidStub();
        $userCreator = new UserCreator($userValidator, $userRepository);

        $userCreator->create('username', 'password');

        $createdUser = $userRepository->findByUsername('username');
        $this->assertEquals(null, $createdUser);
    }

    /** @test */
    public function shouldCreateNewUserWhenUsernameValidFake()
    {
        $userRepository = new UserRepositoryInMemory();
        $usernameValidator = new UsernameValidatorValidStub();
        $userCreator = new UserCreator($usernameValidator, $userRepository);

        $userCreator->create('username', 'password');

        $createdUser = $userRepository->findByUsername('username');
        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals('username', $createdUser->username());
        $this->assertEquals(sha1('password'), $createdUser->password());
    }
}