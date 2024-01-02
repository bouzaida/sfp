<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/todo")]
class TodoController extends AbstractController


{
    #[Route('', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        //afficher notre tableau de togo
        //sinon , je l'initialise puis j'affiche
        if (!$session->has(name: 'todos')) {
            $todos = array(
                'achat' => 'acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            );
            $session->set('todos', $todos);
            $this->addFlash(type: 'info', message: "la liste de todo vient d'ètre initialisée");
        }
        //si j'ai mon tableau de togo dans ma session , je ne fais que l'afficher

        return $this->render('todo/index.html.twig');
    }

    #[Route(
        '/add/{name}/{content}', 
        name: 'todo.add',
        defaults: ['content' => 'sf6']

        )]
    public function addTodo(Request $request, $name, $content) : RedirectResponse
    {
        $session = $request->getSession();

        //verifier si j'ai mon tableau de todo dans la session
        if ($session->has(name: 'todos')) {
            //si oui 
            //vérifier si on a un todo avec le meme name
            $todos = $session->get(name: 'todos');
            if (isset($todos[$name])) {
                //si oui afficher erreur
                $this->addFlash(type: 'error', message: "le todo de id $name existe déjà");
            } else {
                //si non on l'ajoute et on affiche un message de success
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash(type: 'success', message: "le todo de id $name a été ajouté avec succès");
            }
        } else {
            //si non 
            //afficher une erreur et on va rediriger vers le controlleur initial (index)
            $this->addFlash(type: 'error', message: "la liste de todo n'est pas encore initialisée");
        }

        // Use the correct route name for redirection
        return $this->redirectToRoute(route: 'app_todo');
    }
    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content) : RedirectResponse
    {
        $session = $request->getSession();
    
        // Check if the todos array exists in the session
        if ($session->has(name: 'todos')) {
            $todos = $session->get(name: 'todos');
            
            // Check if the todo with the given name exists
            if (isset($todos[$name])) {
                // Update the todo content
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash(type: 'success', message: "Le todo de id $name a été modifié avec succès");
            } else {
                // If the todo does not exist, display an error
                $this->addFlash(type: 'error', message: "Le todo de id $name n'existe pas dans la liste");
            }
        } else {
            // If the todos array does not exist, display an error
            $this->addFlash(type: 'error', message: "La liste de todo n'est pas encore initialisée");
        }
    
        // Redirect to the todo index page
        return $this->redirectToRoute(route: 'app_todo');
    }
    
    #[Route('/delete/{name}', name: 'todo.delete')]
public function deleteTodo(Request $request, $name) : RedirectResponse
{
    $session = $request->getSession();

    // Check if the todos array exists in the session
    if ($session->has(name: 'todos')) {
        $todos = $session->get(name: 'todos');

        // Check if the todo with the given name exists
        if (isset($todos[$name])) {
            // Remove the todo and update the session
            unset($todos[$name]);
            $session->set('todos', $todos);
            $this->addFlash(type: 'success', message: "Le todo de id $name a été supprimé avec succès");
        } else {
            // If the todo does not exist, display an error
            $this->addFlash(type: 'error', message: "Le todo de id $name n'existe pas dans la liste");
        }
    } else {
        // If the todos array does not exist, display an error
        $this->addFlash(type: 'error', message: "La liste de todo n'est pas encore initialisée");
    }

    // Redirect to the todo index page
    return $this->redirectToRoute(route: 'app_todo');
}

    #[Route('/reset', name: 'todo.reset')]

    public function resetTodo(Request $request) : RedirectResponse
    {
        $session = $request->getSession();

        $session->remove(name: 'todos');

        // Use the correct route name for redirection
        return $this->redirectToRoute(route: 'app_todo');
    }
}
