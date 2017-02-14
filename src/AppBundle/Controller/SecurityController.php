<?php
// src/AppBundle/Controller/SecurityController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Security controller.
 *
 * @Route("/")
 */
class SecurityController extends Controller
{
  /**
    * @Route("/administration/login", name="login")
    */
   public function loginAction(Request $request)
   {
     $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('security/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
   }
   /**
     * @Route("/administration/", name="administration")
     */
    public function administrationAction(Request $request)
    {
     return $this->render('security/administration.html.twig');
    }
}
