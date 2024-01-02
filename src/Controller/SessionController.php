<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Request $request): Response
    {
              //session_start()
              $session = $request->getSession();
              if($session ->has(name:'nbVisite')) {
                  $nberVisite = $session ->get(name: 'nbVisite') + 1;
      
              } else {
                  $nberVisite =1;
      
              }
              $session ->set('nbVisite',$nberVisite);
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
