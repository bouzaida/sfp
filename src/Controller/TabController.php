<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{nb?5}', name: 'app_tab')]
    public function index($nb): Response
    {
        $notes = [];
        for ($i = 0; $i < $nb; $i++) {
            $notes[] = rand(0, 20);
        }

        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }

    #[Route('/tab/users', name: 'app.users')]
    public function users(): Response

    {
        $users = [
            ['FirstName' => 'Bouzaida', 'Name' => 'Souheil', 'Age' => '33'],
            ['FirstName' => 'Pchikta', 'Name' => 'Awwa', 'Age' => '65'],
            ['FirstName' => 'Balde', 'Name' => 'Diane', 'Age' => '43'],
        ];

        return $this->render('tab/users.html.twig', [
            'users' => $users,
        ]);
    }
}
