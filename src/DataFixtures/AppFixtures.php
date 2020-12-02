<?php

namespace App\DataFixtures;

use App\Entity\Data\Address;
use App\Entity\TaskList;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $jane = new User('Jane Doe', 'jane.doe@example.com', new Address('10 Bakerstreet', '12345', 'London'));
        $jane->updatePassword($this->encoder->encodePassword($jane, 'test123'));

        $manager->persist($jane);

        $john = new User('John Doe', 'john.doe@example.com', new Address('10 Bakerstreet', '12345', 'London'));
        $john->updatePassword($this->encoder->encodePassword($jane, 'test123'));

        $manager->persist($john);

        $janesList = new TaskList($jane, 'SymfonyWorld 2020');
        $janesList->addItem('Prepare Workshop');
        $janesList->addItem('Setup Zoom Meeting');
        $janesList->addItem('Check Mic');
        $janesList->addItem('Create GitHub repository');

        $janesList->addContributor($john);

        $manager->persist($janesList);

        $johnsList = new TaskList($john, 'SymfonyWorld 2021');
        $johnsList->addItem('Prepare Workshop');
        $johnsList->addItem('Setup Zoom Meeting');
        $johnsList->addItem('Check Mic');
        $johnsList->addItem('Create GitHub repository');

        $manager->persist($johnsList);

        $manager->flush();
    }
}
