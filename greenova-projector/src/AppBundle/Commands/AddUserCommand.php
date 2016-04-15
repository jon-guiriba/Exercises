<?php

namespace AppBundle\Commands;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class AddUserCommand {

    private $em;

    /**
     * @var \Symfony\Component\HttpFoundation\Request 
     */
    private $request;

    public function __construct($em, Request $request) {
        $this->em = $em;
        $this->request = $request;
    }

    public function execute() {
        
            $lastName = $this->request->get('lastname');
            $firstName = $this->request->get('firstname');
            $userName = $this->request->get('username');
            $password = $this->request->get('password');

            $user = new User();
            $user->setLastname($lastName);
            $user->setFirstname($firstName);
            $user->setUsername($userName);
            $user->setPassword($password);

            $error = $this->checkLastName($lastName);

            if ($error == 1) {
                $error = $this->checkFirstName($firstName);
                if ($error  == 1) {
                    $error = $this->checkUserName($userName);
                    if ($error  == 1) {
                        $error = $this->checkPassword($password);
                        if ($error  == 1) {
                            $this->em->persist($user);
                            $this->em->flush();
                            return;
                        }
                    }
                }
            }
            return $error;
 
        
    }

    private function checkLastName($lastName) {
        if (strlen($lastName) < 2) {
            return "lastname must be at least 2 characters long";
        }
        if (strlen($lastName) > 50) {
            return "lastname cannot exceed 50 characters";
        }
        if ($lastName == null) {
            return "lastname cannot be empty";
        }
        return 1;
    }

    private function checkFirstName($firstName) {

        if (strlen($firstName) < 2) {
            return "firstname must be at least 2 characters long";
        }
        if (strlen($firstName) > 50) {
            return "firstname cannot exceed 50 characters";
        }
        if ($firstName == null) {
            return "firstname cannot be empty";
        }
        return 1;
    }

    private function checkUserName($userName) {
        if (!filter_var($userName, FILTER_VALIDATE_EMAIL)) {
            return "username must be valid";
        }
        if (strlen($userName) > 200) {
            return "username cannot exceed 200 characters";
        }
        if (strlen($userName) < 5) {
            return "username must be at least 5 characters long";
        }
        if ($userName == null) {
            return "username cannot be empty";
        }


        return 1;
    }

    private function checkPassword($password) {
        if (!preg_match('/^[A-Za-z0-9_~\-!@#\$\%\^&\*\(\)]+$/', $password)) {
            return "password cannot have space and can only contain special characters: "
                    . "_~\-!@#$%^&*()";
        }
        if (strlen($password) > 11) {
            return "password cannot exceed 11 characters";
        }
        if (strlen($password) < 7) {
            return "password must be at least 5 characters long";
        }
        if ($password == null) {
            return "password cannot be empty";
        }
        return 1;
    }

}
