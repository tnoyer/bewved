<?php

namespace App\Controller\BackOffice;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller\BackOffice
 * @Route("/admin/session", name="session_")
 */
class SessionController extends AbstractController
{
    /**
     * @Route("/manage", name="manage")
     * @param SessionRepository $sessionRepository
     * @return Response
     */
    public function manage(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findAll();
        return $this->render('back/session/manage.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="detail")
     * @param $id
     * @param SessionRepository $sessionRepository
     * @return RedirectResponse|Response
     */
    public function detail($id, SessionRepository $sessionRepository)
    {
        //on récupère la session
        $session = $sessionRepository->findOneBy(['id' => $id]);

        if(!$session){
            // Si aucune session n'est trouvée, nous créons une exception
            //throw $this->createNotFoundException('La session n\'existe pas');

            $this->addFlash('error', 'La session n\'existe pas!');
            return $this->redirectToRoute('session_manage');
        }

        return $this->render('back/session/detail.html.twig', [
            'session' => $session
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $session = new Session();
        $sessionForm = $this->createForm(SessionType::class, $session);
        $sessionForm->handleRequest($request);

        if($sessionForm->isSubmitted() && $sessionForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();
            $this->addFlash('success', 'La session a bien été ajoutée!');
            return $this->redirectToRoute('session_manage');
        }

        return $this->render('back/session/create.html.twig', [
            "sessionForm" => $sessionForm->createView(),
            "session" => $session
        ]);
    }

    /**
     * @Route("/update/{id}", name="update")
     * @param Session $session
     * @param Request $request
     * @return Response
     */
    public function update(Session $session, Request $request): Response
    {
        $sessionForm = $this->createForm(SessionType::class, $session);
        $sessionForm->handleRequest($request);

        if($sessionForm->isSubmitted() && $sessionForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();
            $this->addFlash('success', 'La session a bien été modifiée!');
            return $this->redirectToRoute('session_manage');
        }

        return $this->render('back/session/update.html.twig', [
            "sessionForm" => $sessionForm->createView(),
            "$session" => $session
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Session $session
     * @return RedirectResponse
     */
    public function delete(Session $session): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($session);
        $em->flush();
        $this->addFlash('success', 'La session a bien été supprimée!');
        return $this->redirectToRoute('session_manage');
    }
}
