<?php


namespace App\Exceptions;
use Exception;

class NoUsersExceptions extends Exception
{
    public function __construct()
    {
        parent::__construct('No users found.');
    }
}