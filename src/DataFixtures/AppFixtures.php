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
        $user = new User('Jane Doe', 'jane.doe@example.com', new Address('10 Bakerstreet', '12345', 'London'));
        $user->updatePassword($this->encoder->encodePassword($user, 'test123'));

        $manager->persist($user);

        $taskList = new TaskList($user, 'SymfonyWorld 2020');
        $taskList->addItem('Prepare Workshop');
        $taskList->addItem('Setup Zoom Meeting');
        $taskList->addItem('Check Mic');
        $taskList->addItem('Create GitHub repository');

        $manager->persist($taskList);

        $manager->flush();
    }
}
