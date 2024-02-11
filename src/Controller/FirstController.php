<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    #[Route('/template', name: 'template')]
    public function template(): Response
    {
        return $this->render('template.html.twig');
    }

    #[Route('/sayHello/{name}/{firstname}', name: 'sayHello')]
    public function sayHello(Request $request, $name, $firstname): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
            'nom' => $name,
            'prenom' => $firstname,
            'path' => '     '
        ]);
    }


    #[Route('multi/{entier1}/{entier2}')]
    public function multiplication($entier1, $entier2): Response
    {
        $resultat = $entier1 * $entier2;
        return new Response("<h1>$resultat</h1>");
    }
}
