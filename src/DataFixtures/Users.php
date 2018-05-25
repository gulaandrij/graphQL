<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Users extends Fixture implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEmail('admin@mail.com');
        $user->setUsername('admin');
        $user->setPlainPassword('admin');

        $userManager->updateUser($user);

        for ($i=0;$i<100;$i++){
            $user = $userManager->createUser();
            $user->setEmail("admin$i@mail.com");
            $user->setUsername("admin$i");
            $user->setPlainPassword('admin');

            $userManager->updateUser($user);
        }

    }

}
