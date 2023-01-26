<?php

namespace ProgrammerZamanNow\PhpMvc\App {

    function header(string $value){
        echo $value;
    }
}

namespace ProgrammerZamanNow\PhpMvc\Controller {
    use PHPUnit\Framework\TestCase;
    use ProgrammerZamanNow\PhpMvc\Config\Database;
    use ProgrammerZamanNow\PhpMvc\Domain\User;
    use ProgrammerZamanNow\PhpMvc\Repository\UserRepository;
    
    class UserControllerTest extends TestCase
    {  
        private UserController $userController;
        private UserRepository $userRepository;
    
        protected function setUp(): void
        {
            $this->userController = new UserController();
    
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();

            putenv("mode=test");
    
        }
        public function testRegister()
        {
            $this->userController->register();
    
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new User]");
    
    
        }
    
        public function testPostRegisterSuccess()
        {
            $_POST['id'] = '';
            $_POST['name'] = 'Akbar';
            $_POST['password'] = 'rahasia';
    
            $this->userController->postregister();
    
            $this->expectOutputRegex("[Location: /users/login]");
        }
    
        public function testPostRegisterValidationError()
        {
            $_POST['id'] = '';
            $_POST['name'] = 'Akbar';
            $_POST['password'] = 'rahasia';
    
            $this->userController->postregister();
    
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new User]");
            $this->expectOutputRegex("[Id, Name, Password can not blank]");
        }
    
        public function testRegisterDuplicate()
        {
            $user = new User();
            $user->id = "akbar";
            $user->name = "Akbar";
            $user->password = "rahasia";
    
            $this->userRepository->save($user);
    
            $_POST['id'] = 'akbar';
            $_POST['name'] = 'Akbar';
            $_POST['password'] = 'rahasia';
    
            $this->userController->postregister();
    
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new User]");
            $this->expectOutputRegex("[User Id already exists]");
        }
    
    }
}


