<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    public function __construct(private RequestStack $requestStack, private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/contact', name: 'contact.form')]
    public function form(): Response
    {
        //création du formulaire
        $type = ContactType::class;
        $contactEntity = new Contact();
        $form = $this->createForm($type, $contactEntity);

        //récupération des informations du formulaire
        $form->handleRequest(($this->requestStack->getCurrentRequest()));

        //vérifier que le formulaire est soumis et valide.
        if ($form->isSubmitted() && $form->isValid()) {
            //dd($contactEntity);
            $this->addFlash('notice', 'Email envoyé avec succès.');

            $this->entityManager->persist($contactEntity);
            $this->entityManager->flush();

            return $this->redirectToRoute('contact.form');
        }

        return $this->render('contact/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
