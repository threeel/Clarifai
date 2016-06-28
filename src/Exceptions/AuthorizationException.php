<?php
/**
 * Created by PhpStorm.
 * User: threeel
 * Date: 6/28/16
 * Time: 1:58 AM
 */

namespace Threeel\Clarifai\Exceptions;


use Exception;

class AuthorizationException extends Exception
{

    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {


        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }


}