<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//préfixe des routes du contrôleurs
#[Route('/admin')]
class AdminController extends AbstractController
{

    #[Route('/', name: 'admin.index')]
    public function index(): Response
    {
        return $this->render('admin/home/index.html.twig');
    }
}
