<?php
use App\Middleware\DatabaseConnetion;

class BaseController 
{
    public function __construct()
    {
        return new DatabaseConnetion();
    }
}

?>