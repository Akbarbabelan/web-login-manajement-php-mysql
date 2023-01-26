<?php

namespace ProgrammerZamanNow\PhpMvc\Controller;

use ProgrammerZamanNow\PhpMvc\App\view;

class HomeController
{
    function index(){
        View::render('Home/index', [
            "title" => "PHP Login Management"
        ]);
    }
}