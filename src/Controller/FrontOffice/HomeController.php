<?php

namespace App\Controller\FrontOffice;

use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param SessionRepository $sessionRepository
     * @return Response
     */
    public function index(SessionRepository $sessionRepository): Response
    {
        $user = $this->getUser();
        return $this->render('front/home/index.html.twig', [
            'currentUser' => $user
        ]);
    }
}
