<?php

namespace App\Controller\BackOffice;

use App\Repository\PromotionRepository;
use App\Repository\SessionRepository;
use App\Repository\SkillRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="dashboard")
     * @param UserRepository $userRepository
     * @param SessionRepository $sessionRepository
     * @param SkillRepository $skillRepository
     * @param PromotionRepository $promotionRepository
     * @return Response
     */
    public function index(UserRepository $userRepository, SessionRepository $sessionRepository, SkillRepository $skillRepository, PromotionRepository $promotionRepository): Response
    {
        $users = $userRepository->findAll();
        $sessions = $sessionRepository->findAll();
        $skills = $skillRepository->findAll();
        $promotions = $promotionRepository->findAll();
        return $this->render('back/dashboard/index.html.twig', [
            'users' => $users,
            'sessions' => $sessions,
            'skills' => $skills,
            'promotions' => $promotions
        ]);
    }
}
