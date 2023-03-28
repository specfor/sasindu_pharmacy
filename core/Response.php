<?php

namespace LogicLeap\SasinduPharmacy\core;

class Response
{
    public const STATUS_CODE_SUCCESS = 200;
    public const STATUS_CODE_FORBIDDEN = 403;
    public const STATUS_CODE_NOT_FOUND = 404;

    /**
     * Set the status-code of the response to the code passed.
     */
    public function setStatusCode(int $code) : void
    {
        http_response_code($code);
    }

    /**
     * Redirect user to the given path
     */
    public function redirect(string $url) : void
    {
        header("Location: " . $url);
    }
}