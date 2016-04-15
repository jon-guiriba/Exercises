<?php

namespace AppBundle\Controllers;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Commands\AddUserCommand;
use AppBundle\ViewModels\Persons\PersonsModel;

class PersonsController extends Controller {

    /**
     * @Route("projector/persons/create", name="persons_create_get")
     * @Method("GET")
     */
    public function createGetAction(Request $request) {
        $error = " ";
        return $this->render('@AppBundle/Views/projector/persons_create.html.twig', array('errormsg' => $error));
    }

    /**
     * @Route("projector/persons/create", name="persons_create_post")
     * @Method("POST")
     */
    public function createPostAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $model = new PersonsModel($em, $request);
        $error = $model->addUser();


        return $this->render('@AppBundle/Views/projector/persons_create.html.twig', array('errormsg' => $error));
    }

}
