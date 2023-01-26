<?php

namespace ProgrammerZamanNow\PhpMvc\Middleware;

interface Middleware
{

    function before(): void;
}