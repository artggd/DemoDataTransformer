<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller des utilisateurs
 * 
 * @author aguigand <aguigand@umanit.fr>
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * Vue d'inscription d'un utilisateur
     * 
     * @Route("/sign-in")
     * @Template("AppBundle:User:create.html.twig")
     */
    public function signInAction(Request $request)
    {
    }

}
