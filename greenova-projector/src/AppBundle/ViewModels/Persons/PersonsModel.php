<?php

namespace AppBundle\ViewModels\Persons;

use AppBundle\Commands\AddUserCommand;

class PersonsModel {

    private $em,$request;
    
    public function __construct($em, $request) {
        $this->em = $em;
        $this->request = $request;
    }
    
    public function addUser() {

        $command = new AddUserCommand($this->em, $this->request);
        $error = $command->execute();
        

        return $error;
    }

//    public function getAllProjects($repository) {
//        $query = new GetAllProjectsQuery($repository);
//        $model = array('projects' => $query->execute());
//
//        return $model;
//    }
}
