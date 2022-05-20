<?php

namespace App\Controller\FrontOffice;

use App\Entity\Session;
use App\Entity\User;
use App\Repository\GroupRepository;
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

        if (!$session) {
            // If we find no session, we generate an exception
            throw $this->createNotFoundException('La session n\'existe pas');

            return $this->redirectToRoute('home');

        }
            return $this->render('front/session_details/index.html.twig', [
                'session' => $session
            ]);

    }

        /**
         * @Route("/group/{id}", name="app_group_details")
         * @param $id
         * @param GroupRepository $groupRepository
         * @return Response
         */
        public function groupIndex($id, GroupRepository $groupRepository): Response
        {
            $group = $groupRepository->findOneBy(['id' => $id]);

            if (!$group) {
                // Si aucune session n'est trouvée, nous créons une exception
                throw $this->createNotFoundException("This group doesn't exist ");

                return $this->redirectToRoute('home');
            }

            return $this->render('front/group_details/index.html.twig', [
                'group' => $group]);
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
