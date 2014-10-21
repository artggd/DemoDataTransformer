<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;

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
     * @param Request $request
     * @return array
     */
    public function signInAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user, array(
            'em' => $this->getDoctrine()->getManager()
        ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            // Enregistrement en base
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
        }

        return array(
            'form' => $form->createView(),
            'valid' => $form->isValid()
        );
    }

}
