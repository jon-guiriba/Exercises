<?php

namespace AppBundle\Commands;

use AppBundle\Entity\Project;

class AddProjectCommand {

    private $em, $request;

    public function __construct($em, $request) {

        $this->em = $em;
        $this->request = $request;
    }

    public function execute() {

        $code = $this->request->get('code');
        $name = $this->request->get('name');
        $budget = $this->request->get('budget');
        $remarks = trim($this->request->get('remarks'));

        if ($code == null || $name == null || $budget == null || $remarks == null) {
            return 0;
        }

        

        $this->project = new Project();
        $this->project->setCode($code);
        $this->project->setName($name);
        $this->project->setBudget($budget);
        $this->project->setRemarks($remarks);

        $this->em->persist($this->project);
        $this->em->flush();
        
        return 1;
    }

}
