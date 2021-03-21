<?php

namespace Etsik\Model\Validator;

use Etsik\Core\Validator;

class UserValidator extends Validator
{
    private $userManager;

    public function __construct($userManager)
    {
        $this->userManager = $userManager;
    }

    public function ifEmailExist($email)
    {
        if ($this->userManager->findByEmail($email)) {
            return true;
        }

        return false;
    }
}
