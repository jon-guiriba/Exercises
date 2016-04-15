<?php

namespace AppBundle\ViewModels\Projects;

use AppBundle\Queries\GetAllProjectsQuery;

class ProjectsModel {

    public function getAllProjects($repository) {
        $query = new GetAllProjectsQuery($repository);
        $model = array('projects' => $query->execute());

        return $model;
    }

//    public function getAllProjects($repository) {
//        $query = new GetAllProjectsQuery($repository);
//        $model = array('projects' => $query->execute());
//
//        return $model;
//    }

}
