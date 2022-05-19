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
     * @Route("/detail/{id}", name="app_session_details")
     * @param $id
     * @param SessionRepository $sessionRepository
     * @return Response
     */
    public function index($id, SessionRepository $sessionRepository): Response
    {
        $session = $sessionRepository->findOneBy(['id' => $id]);

        if(!$session){
            // Si aucune session n'est trouvée, nous créons une exception
            throw $this->createNotFoundException('La session n\'existe pas');

            return $this->redirectToRoute('home');
        }

        return $this->render('front/session_details/index.html.twig', [
            'session' => $session
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
