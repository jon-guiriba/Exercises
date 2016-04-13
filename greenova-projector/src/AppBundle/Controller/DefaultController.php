<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/default/hello", name="hello")
     */
    public function helloAction(Request $request)
    {
        $model = [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ];
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', $model);
    }
     /**
     * @Route("/rootga", name="rootga")
     */
    public function indexAction(Request $request) {
        return $this->redirectToRoute(["SSA"]);
    }
   
}
