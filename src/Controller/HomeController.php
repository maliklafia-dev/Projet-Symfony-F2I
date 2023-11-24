<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /*
        requête http
        -contenue dans une classe RequestStack
        -injection de dépendances : accéder ç une classe dans une autre cmasse
        - dans symfony, l'injection de dépendances se fait par le constructeur


        propriété de la requête
            request : $_POST
            query : $_GET
    */


    public function __construct(private RequestStack $requestStack)
    {

        $post = $this->requestStack->getMainRequest()->request->get('key');
    }


    #[Route('/', name: 'home.index')]

    public function index(): Response
    {
        /*
            debogage : 
                    dump : afficher la donnée dans la page
                    dd (dump and die) : afficher la donnée puis stopper le script

        */
        // dd($this->requestStack->getMainRequest());

        // return new Response(
        //     '<h1>Je suis Malik, un développeur ;)</h1> ',
        //     Response::HTTP_CREATED,
        //     ['Content-Type' => 'application/json']
        // );

        return $this->render('home/index.html.twig', [
            'names' => ['Malik', 'LAFIA'], 'skills' => [
                '1' => 'developpeur',
                '2' => 'designer'
            ],
            'date' => new \DateTime(),
        ]);
    }

    #[Route('/hello/{name}', name: 'home.hello')]
    public function hello(string $name): Response
    {
        return $this->render('home/hello.html.twig', ['name' => $name]);
    }
}
