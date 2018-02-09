<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture {

    public function load(ObjectManager $manager) {
        //on cree un admin pour accéder a notre backoffice
        $admin = new User();
        $admin->setRoles('ROLE_USER|ROLE_ADMIN');
        $admin->setUsername('root');
        $admin->setPassword(password_hash('root', PASSWORD_BCRYPT));
        $admin->setEmail('admin@noreply.com');
        $admin->setBirthdate(
                \DateTime::createFromformat('Y/m/d', '1978/12/23'));
        $manager->persist($admin);

        for ($i = 1; $i <= 20; $i++) {
            $user = new User();
            $user->setUsername('user' . $i);
            $user->setEmail('user' . $i . '@mail.com');
            $user->setFirstname('User' . $i);
            $user->setLastname('Fake');
            $user->setRoles('ROLE_USER');
            $user->setPassword(password_hash('user' . $i, PASSWORD_BCRYPT));

            $user->setBirthdate(\DateTime::createFromFormat('Y/m/d h:i:s', (2000 - $i) . '/01/01 00:00:00'));
            //on demande au manager  d'enregistrer l'utilisateur en bases de données
            //notre user référencé dans les autres fixtures sous la clé
            //user0 puis userl puis user

            $this->addReference('user' . $i, $user);
            $manager->persist($user);
        }
        $manager->flush(); // les INSERT INTO ne sont effectués qu'a ce moment la
    }

}
