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

        $skill4 = new Skill();
        $skill4->setName('HTML');
        $manager->persist($skill4);

        $skill5 = new Skill();
        $skill5->setName('CSS');
        $manager->persist($skill5);

        //session
        $session = new Session();
        $session->setName('Formation Python');
        $session->setImage('python3.jpg');
        $session->setStart(new \DateTimeImmutable("2022-05-26"));
        $session->setEnd(new \DateTimeImmutable("2022-06-26"));
        $session->setSize(15);
        $manager->persist($session);

        $session2 = new Session();
        $session2->setName('Formation PHP');
        $session2->setStart(new \DateTimeImmutable("2022-05-26"));
        $session2->setEnd(new \DateTimeImmutable("2022-06-26"));
        $session2->setSize(15);
        $manager->persist($session2);

        $session3 = new Session();
        $session3->setName('Formation JAVA');
        $session3->setStart(new \DateTimeImmutable("2022-06-27"));
        $session3->setEnd(new \DateTimeImmutable("2022-07-26"));
        $session3->setSize(20);
        $manager->persist($session3);

        $session4 = new Session();
        $session4->setName('Formation C#');
        $session4->setStart(new \DateTimeImmutable("2022-07-27"));
        $session4->setEnd(new \DateTimeImmutable("2022-08-26"));
        $session4->setSize(20);
        $manager->persist($session4);

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
        $admin->addSkill($skill2);
        $admin->addSkill($skill3);
        $admin->addSesssion($session);
        $admin->addSesssion($session2);
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
        $user->addSkill($skill4);
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

        $user3 = new User();
        $user3->setPassword($this->passwordEncoder->encodePassword($user3, '123456'));
        $user3->setFirstname('Daeneris');
        $user3->setLastname('Targaryen');
        $user3->addSkill($skill2);
        $user3->addSkill($skill4);
        $user3->addSesssion($session2);
        $user3->setAge(26);
        $user3->setGender('femme');
        $user3->setPromotion($promotion2);
        $user3->setUsername('daeneristargaryen');
        $user3->setRoles(['ROLE_USER']);
        $manager->persist($user3);

        $user4 = new User();
        $user4->setPassword($this->passwordEncoder->encodePassword($user4, '123456'));
        $user4->setFirstname('Géralt');
        $user4->setLastname('De Riv');
        $user4->addSkill($skill2);
        $user4->addSkill($skill4);
        $user4->addSesssion($session);
        $user4->setAge(31);
        $user4->setGender('homme');
        $user4->setPromotion($promotion2);
        $user4->setUsername('geraltderiv');
        $user4->setRoles(['ROLE_USER']);
        $manager->persist($user4);

        $user5 = new User();
        $user5->setPassword($this->passwordEncoder->encodePassword($user5, '123456'));
        $user5->setFirstname('Yennefer');
        $user5->setLastname('De Venderberg');
        $user5->addSkill($skill2);
        $user5->addSkill($skill4);
        $user5->addSesssion($session);
        $user5->setAge(31);
        $user5->setGender('femme');
        $user5->setPromotion($promotion2);
        $user5->setUsername('yenneferdevenderberg');
        $user5->setRoles(['ROLE_USER']);
        $manager->persist($user5);

        $manager->flush();
    }
}
