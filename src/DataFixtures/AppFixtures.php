<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Website;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setEmail('contact@test.fr')
            ->setPassword('test');
        $encoded = $this->encoder->encodePassword($admin, $admin->getPassword());
        $admin->setPassword($encoded);
        $manager->persist($admin);

        $website = new Website();
        $website->setName('Youtube')
            ->setUrl('https://youtube.com');
        $manager->persist($website);
        
        $website = new Website();
        $website->setName('Facebook')
            ->setUrl('https://facebook.com');
        $manager->persist($website);
        
        $website = new Website();
        $website->setName('Google')
            ->setUrl('https://google.com');
        $manager->persist($website);
        
        $website = new Website();
        $website->setName('Github')
            ->setUrl('https://github.com');
        $manager->persist($website);
        
        $website = new Website();
        $website->setName('GithubTest')
            ->setUrl('https://github.com/ufheriuhf');
        $manager->persist($website);
        
        $website = new Website();
        $website->setName('testError')
            ->setUrl('https://testerrored.ccom/gufuelkhdfoih');
        $manager->persist($website);


        $manager->flush();
    }
}
