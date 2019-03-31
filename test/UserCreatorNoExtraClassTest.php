<?php

namespace Test;

use DoublesMeetup\UserCreator;
use DoublesMeetup\UsernameValidator;
use DoublesMeetup\UserRepository;
use PHPUnit\Framework\TestCase;
use Test\Dummy\UserRepositoryDummy;

class UserCreatorNoExtraClassTest extends TestCase
{
    /**
     * @test
     */
    public function shouldThrowExceptionWhenUsernameInvalid()
    {
        $this->expectException(\Exception::class);

        $username          = 'username';
        $userRepository    = new UserRepositoryDummy();
        $usernameValidator = $this->getMockBuilder(UsernameValidator::class)
                                  ->getMock();
        $usernameValidator->expects($this->any())
                          ->method('validate')
                          ->willReturn(false);

        $userCreator = new UserCreator($usernameValidator, $userRepository);

        $userCreator->create($username, 'password');
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUsernameInvalidWithMockery()
    {
        $this->expectException(\Exception::class);

        $userRepository    = new UserRepositoryDummy();
        $usernameValidator = \Mockery::mock(UsernameValidator::class);
        $usernameValidator->shouldReceive('validate')
                          ->once()
                          ->with(self::equalTo('username'))
                          ->andReturn(false);

        $userCreator = new UserCreator($usernameValidator, $userRepository);

        $userCreator->create('username', 'password');
    }


    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValidNoExtraClasses()
    {
        $username                     = 'username';
        $password                     = 'password';
        $userRepository               = $this->createMock(UserRepository::class);
        $usernameValidatorAlwaysValid = $this->getMockBuilder(UsernameValidator::class)
                                             ->getMock();
        $usernameValidatorAlwaysValid->expects($this->any())
                                     ->method('validate')
                                     ->with($username)
                                     ->willReturn(true);

        $userCreator = new UserCreator($usernameValidatorAlwaysValid, $userRepository);
        $createdUser = $userCreator->create($username, $password);

        $this->assertEquals('username', $createdUser->username());
        $this->assertEquals(sha1('password'), $createdUser->password());
    }

    /**
     * @test
     */
    public function shouldCreateNewUserWhenUsernameValidNoExtraClassesWithMockery()
    {
        $username                     = 'username';
        $password                     = 'password';
        $userRepository               = $this->createMock(UserRepository::class);
        $usernameValidatorAlwaysValid = \Mockery::mock(UsernameValidator::class);
        $usernameValidatorAlwaysValid->shouldReceive('validate')
                                     ->once()
                                     ->with($username)
                                     ->andReturn(true);
        $userCreator = new UserCreator($usernameValidatorAlwaysValid, $userRepository);
        $createdUser = $userCreator->create($username, $password);

        $this->assertEquals($username, $createdUser->username());
        $this->assertEquals(sha1($password), $createdUser->password());
    }
}