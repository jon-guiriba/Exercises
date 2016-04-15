<?php

namespace AppBundle\Controllers;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use AppBundle\ViewModels\Projects\ProjectsModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Commands\AddProjectCommand;

class ProjectorController extends Controller {

    /**
     * @Route("/projector/projects", name="projects")
     */
    public function projectorAction(Request $request) {

        $repository = $this->getDoctrine()->getRepository('AppBundle:Project');
        $model = new ProjectsModel();
        
        return $this->render('@AppBundle/Views/projector/projects.html.twig', $model->getAllProjects($repository));
    }

    /**
     * @Route("/projector/projects/create", name="projects_create_get")
     * @Method("GET")
     */
    public function createGETAction(Request $request) {
        return $this->render('@AppBundle/Views/projector/projects_create.html.twig');
    }

    /**
     * @Route("/projector/projects/create", name="projects_create_post")
     * @Method("POST")
     */
    public function createPOSTAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $command = new AddProjectCommand($em, $request);
        $command->execute();

        return $this->render('@AppBundle/Views/projector/projects_create.html.twig');
    }

     /**
     * @Route("/projector/projects/assignments", name="projects_assignments")
     * 
     */
    public function assignmentAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $model = new ProjectsModel();
        

        return $this->render('@AppBundle/Views/projector/projects_create.html.twig', $model);
    }
    
}
