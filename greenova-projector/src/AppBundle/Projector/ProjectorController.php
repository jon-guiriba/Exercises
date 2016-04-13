<?php

namespace AppBundle\Projector;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class ProjectorController extends Controller {

    /**
     * @Route("/", name="default")
     */
    public function indexAction(Request $request) {
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/projector/login", name="login")
     */
    public function loginAction(Request $request) {


        //    $session = $request->getSession();
        //    $auth= $this->get('security.authentication_utils');
        //    if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
        //     $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        // } else {
        //     $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        // }
        // $lastUsername = $auth->getLastUsername();

        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                    Security::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        }


        return $this->render(
                        '@Projector/login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $session->get(Security::LAST_USERNAME),
                    'error' => $error,
                        )
        );

        // $model = array(
        //     'last_username' => $lastUsername,
        //     'error' => $error,
        //     );
        //     // replace this example code with whatever you need
        // return $this->render('@Projector/login.html.twig',$model);
    }

    /**
     * @Route("/projector/projects", name="projects")
     */
    public function projectorAction(Request $request) {

//          var_dump("hello");
//        $auth= $this->get('security.authentication_utils');
//        $lastUsername = $auth->getLastUsername();
//
//        $model = array(
//            'username' => $lastUsername,
//
//            );

        $router = $this->get('router');
        $main = $router->generate('main');

        return $this->redirect($main);

//        return $this->render('@Projector/projects.html.twig', $model);
        // return $this->render('default/index.html.twig');
    }

}
