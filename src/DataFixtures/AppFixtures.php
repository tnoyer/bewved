<?php

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\Promotion;
use App\Entity\Session;
use App\Entity\Skill;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        //skill
        $skill = new Skill();
        $skill->setName('Java');
        $manager->persist($skill);




        //session
        $session = new Session();
        $session->setName('Formation Android');
        $session->setStart(new \DateTimeImmutable("2022-05-26"));
        $session->setEnd(new \DateTimeImmutable("2022-06-26"));
        $session->setSize(15);
        $manager->persist($session);



        //promotion
        $promotion = new Promotion();
        $promotion->setName('CDA 2022');
        $manager->persist($promotion);


        //admin
        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user, '654321'));
        $user->setFirstname('Obi-Wan');
        $user->setLastname('Kenobi');
        $user->addSkill($skill);
        $user->addSesssion($session);
        $user->setAge(39);
        $user->setGender('homme');
        $user->setPromotion($promotion);
        $user->setUsername($user->getFirstname()." ".$user->getLastname());
        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);

        //user1
        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user, '654321'));
        $user->setFirstname('Anakin');
        $user->setLastname('SKYWALKER');
        $user->addSkill($skill);
        $user->addSesssion($session);
        $user->setAge(21);
        $user->setGender('homme');
        $user->setPromotion($promotion);
        $user->setUsername($user->getFirstname()." ".$user->getLastname());
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);

        //user2
        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user, '654321'));
        $user->setFirstname('Marc-Eli');
        $user->setLastname('CROAIN');
        $user->addSkill($skill);
        $user->addSesssion($session);
        $user->setAge(25);
        $user->setGender('homme');
        $user->setPromotion($promotion);
        $user->setUsername($user->getFirstname()." ".$user->getLastname());
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);

        //user3
        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user, '654321'));
        $user->setFirstname('Luke');
        $user->setLastname('SKYWALKER');
        $user->addSkill($skill);
        $user->addSesssion($session);
        $user->setAge(18);
        $user->setGender('homme');
        $user->setPromotion($promotion);
        $user->setUsername($user->getFirstname()." ".$user->getLastname());
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);



        $manager->flush();
    }
}