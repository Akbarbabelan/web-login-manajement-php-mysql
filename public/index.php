<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ProgrammerZamanNow\PhpMvc\App\Router;
use ProgrammerZamanNow\PhpMvc\Config\Database;
use ProgrammerZamanNow\PhpMvc\Controller\HomeController;
use ProgrammerZamanNow\PhpMvc\Controller\UserController;

Database::getConnection('prod');

// home controller
Router::add('GET', '/', HomeController::class, 'index', []);

// user controller
Router::add('GET', '/users/register', UserController::class, 'register', []);
Router::add('POST', '/users/register', UserController::class, 'postRegister', []);
Router::add('POST', '/users/login', UserController::class, 'login', []);
Router::add('POST', '/users/login', UserController::class, 'postLogin', []);




Router::run();
