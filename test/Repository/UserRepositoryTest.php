<?php

namespace ProgrammerZamanNow\PhpMvc\Repository;

use PHPUnit\Framework\TestCase;
use ProgrammerZamanNow\PhpMvc\Config\Database;
use ProgrammerZamanNow\PhpMvc\Domain\User;

class UserRepositoryTest extends TestCase
{

    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $user = new User();
        $user->id = "akbar";
        $user->name = "Akbar";
        $user->password = "rahasia";

        $this->userRepository->save($user);

        $result = $this->userRepository->findById($user->id);

        self::assertEquals($user->id, $result->id);
        self::assertEquals($user->name, $result->name);
        self::assertEquals($user->password, $result->password);
    }

    public function testFindById()
    {
        $user = $this->userRepository->findById("notfound");
        self::assertNull($user);
    }
}