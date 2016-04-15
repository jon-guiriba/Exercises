<?php

namespace AppBundle\Queries;



class GetAllProjectsQuery {
    
    private $repository;
    
    public function __construct($repository) {
        $this->repository = $repository;
    }

    public function execute() {
        $resultSet = $this->repository->findAll();
        return $resultSet;
    }

}
