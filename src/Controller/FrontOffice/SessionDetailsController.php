<?php

namespace App\Controller\FrontOffice;

use App\Entity\Session;
use App\Entity\User;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionDetailsController extends AbstractController
{
    /**
     * @Route("/details", name="app_session_details")
     * @param SessionRepository $userRepository
     * @return Response
     */
    public function index(SessionRepository $sessionRepository): Response
    {
        $session = $sessionRepository->find(4);
        //$users = $userRepository->findAll();
        return $this->render('front/session_details/index.html.twig', [
            'controller_name' => 'SessionDetailsController',
            //'users' => $users,
            'session' => $session,
        ]);
    }

    /**
     * @Route("/manage", name="manage")
     * @param UserRepository $userRepository
     * @return Response

    public function manage(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('back/user/manage.html.twig', [
            'users' => $users,
        ]);
    }*/
}
