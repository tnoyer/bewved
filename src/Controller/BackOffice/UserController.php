<?php

namespace App\Controller\BackOffice;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package App\Controller\BackOffice
 * @Route("/admin/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/detail/me", name="detailMe")
     * @return RedirectResponse|Response
     */
    public function detailMe()
    {
        //on récupère l'utilisateur connecté
        $me = $this->getUser();

        if(!$me){
            // Si aucun utilisateur n'est trouvé, nous créons une exception
            //throw $this->createNotFoundException('Le profil n\'existe pas');

            $this->addFlash('error', 'Le profil n\'existe pas!');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('back/user/me.html.twig', [
            'me' => $me
        ]);
    }

    /**
     * @Route("/manage", name="manage")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function manage(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('back/user/manage.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="detail")
     * @param $id
     * @param UserRepository $userRepository
     * @return RedirectResponse|Response
     */
    public function detail($id, UserRepository $userRepository)
    {
        //on récupère l'apprenant'
        $user = $userRepository->findOneBy(['id' => $id]);

        if(!$user){
            // Si aucun apprenant n'est trouvé, nous créons une exception
            //throw $this->createNotFoundException('L\'expérience professionnelle n\'existe pas');

            $this->addFlash('error', 'L\'apprenant n\'existe pas!');
            return $this->redirectToRoute('user_manage');
        }

        return $this->render('back/user/detail.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);

        if($userForm->isSubmitted() && $userForm->isValid()){
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $userForm->get('password')->getData()
                )
            );
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'L\'utilisateur a bien été ajouté!');
            return $this->redirectToRoute('user_manage');
        }

        return $this->render('back/user/create.html.twig', [
            "userForm" => $userForm->createView(),
            "user" => $user
        ]);
    }

    /**
     * @Route("/update/{id}", name="update")
     * @param User $user
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function update(User $user, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);

        if($userForm->isSubmitted() && $userForm->isValid()){
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $userForm->get('password')->getData()
                )
            );
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'L\'utilisateur a bien été modifié!');
            return $this->redirectToRoute('user_manage');
        }

        return $this->render('back/user/update.html.twig', [
            "userForm" => $userForm->createView(),
            "user" => $user
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param User $user
     * @return RedirectResponse
     */
    public function delete(User $user): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'L\'utilisateur a bien été supprimé!');
        return $this->redirectToRoute('user_manage');
    }
}
