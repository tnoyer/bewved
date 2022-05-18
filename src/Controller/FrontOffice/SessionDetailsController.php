<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionDetailsController extends AbstractController
{
    /**
     * @Route("/details", name="app_session_details")
     */
    public function index(): Response
    {
        return $this->render('front/session_details/index.html.twig', [
            'controller_name' => 'SessionDetailsController',
        ]);
    }
}
