<?php

namespace LogicLeap\SasinduPharmacy\core\exceptions;

class  NotFoundException extends \Exception
{
    protected $code = 404;
    protected $message = "Page not Found.";
}