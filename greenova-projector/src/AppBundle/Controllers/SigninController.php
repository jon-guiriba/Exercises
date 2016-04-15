<?php

namespace AppBundle\Controllers;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class SigninController extends Controller {

    /**
     * @Route("/", name="default")
     */
    public function indexAction(Request $request) {
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/projector/signin", name="login")
     */
    public function loginAction(Request $request) {

        $session = $request->getSession();
//        $model = array('last_username'=>null,'error'=>null);

        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                    Security::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        }
        
        
        return $this->render(
                        '@AppBundle/Views/projector/login.html.twig', array(
                    'last_username' => $session->get(Security::LAST_USERNAME),
                    'error' => $error,
        ));
    }

    /**
     * @Route("/projector/login_check", name="login_check")
     */
    public function login_checkAction(Request $request) {

        $userToken = $this->get('security.token_storage')->getToken();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Projects');


        $projects = $repository->findAll();
        if (!$projects) {
            throw $this->createNotFoundException(
                    'No product found for id ' . $projects
            );
        }
        $username = $userToken->getUser()->getUsername();

        $model = array(
            'username' => $username,
            'projects' => $projects
        );

        return $this->render('@AppBundle/Views/projector/projects.html.twig', $model);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request) {
        return $this->redirectToRoute('login');
    }

}
