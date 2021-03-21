<?php

namespace Etsik\Core;

/**
 * Class use to valid data.
 */
class Validator
{
    public function validEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }
}
