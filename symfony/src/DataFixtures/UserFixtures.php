<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstname('Romain');
        $user->setLastname('De Sa Jardim');
        $user->setUsername('rdsj');
        $user->setBirthday(new \DateTime('1994-05-21'));
        $user->setGender('Monsieur');

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'test123'
        ));

        $manager->persist($user);
        $manager->flush();
    }
}
