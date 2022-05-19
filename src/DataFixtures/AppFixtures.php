<?php

namespace App\DataFixtures;

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
        //skills
        $skill = new Skill();
        $skill->setName('Java');
        $manager->persist($skill);

        $skill2 = new Skill();
        $skill2->setName('PHP');
        $manager->persist($skill2);

        $skill3 = new Skill();
        $skill3->setName('Javascript');
        $manager->persist($skill3);

        //session
        $session = new Session();
        $session->setName('Formation Android');
        $session->setStart(new \DateTimeImmutable("2022-05-26"));
        $session->setEnd(new \DateTimeImmutable("2022-06-26"));
        $session->setSize(15);
        $manager->persist($session);

        $session = new Session();
        $session->setName('Formation Android');
        $session->setStart(new \DateTimeImmutable("2022-05-26"));
        $session->setEnd(new \DateTimeImmutable("2022-06-26"));
        $session->setSize(15);
        $manager->persist($session);

        $session2 = new Session();
        $session2->setName('Formation JAVA');
        $session2->setStart(new \DateTimeImmutable("2022-06-27"));
        $session2->setEnd(new \DateTimeImmutable("2022-07-26"));
        $session2->setSize(20);
        $manager->persist($session2);

        //promotion
        $promotion = new Promotion();
        $promotion->setName('CDA 2022');
        $manager->persist($promotion);

        $promotion2 = new Promotion();
        $promotion2->setName('DWWM 2022');
        $manager->persist($promotion2);

        //user
        $admin = new User();
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, '123456'));
        $admin->setFirstname('Ned');
        $admin->setLastname('Stark');
        $admin->addSkill($skill);
        $admin->addSesssion($session);
        $admin->setAge(32);
        $admin->setGender('homme');
        $admin->setPromotion($promotion);
        $admin->setUsername('nedstark');
        $admin->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $manager->persist($admin);

        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        $user->setFirstname('Alexandre');
        $user->setLastname('Le Grand');
        $user->addSkill($skill2);
        $user->addSesssion($session2);
        $user->setAge(25);
        $user->setGender('homme');
        $user->setPromotion($promotion);
        $user->setUsername('alexandrelegrand');
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $user2 = new User();
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, '123456'));
        $user2->setFirstname('Tyrion');
        $user2->setLastname('Lannister');
        $user2->addSkill($skill2);
        $user2->addSesssion($session2);
        $user2->setAge(25);
        $user2->setGender('homme');
        $user2->setPromotion($promotion);
        $user2->setUsername('tyrionlannister');
        $user2->setRoles(['ROLE_USER']);
        $manager->persist($user2);

        $manager->flush();
    }
}
