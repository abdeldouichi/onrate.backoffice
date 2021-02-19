<?php

namespace App\DataFixtures;

use App\Entity\MockUser;
use App\Entity\Note;
use App\Entity\Rule;
use App\Entity\Topic;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        for($i=0; $i<5; $i++){
            $user = new User();
            $user
                ->setEmail(sprintf("email%d@gmail.com",$i))
                ->setPassword($this->passwordEncoder->encodePassword($user, "password"))
                ->setName(sprintf("email%d",$i))
            ;
            $manager->persist($user);
            $topic = new Topic();
            $topic
                ->setDescription(sprintf("description topic lorem epsum %d", $i))
                ->setTitle(sprintf("title topic lorem epsum %d", $i));
            $topic->setUser($user);
            $user->addTopic($topic);
            $manager->persist($topic);
            for($j=0;$j<5;$j++){
                $rule = new Rule();
                $rule
                    ->setDescription(sprintf("description rule lorem epsum %d%d", $i,$j))
                    ->setTitle(sprintf("Title Rule %d%d", $i,$j))
                    ->setTopic($topic)
                    ->setUser($user);
                $manager->persist($rule);

                $mockUser = new MockUser();
                $mockUser
                    ->setUser($user)
                    ->setFirstname(sprintf("Firstname %d%d", $i,$j))
                    ->setFamilyname(sprintf("Familyname %d%d", $i,$j))
                    ->setUser($user);

                $manager->persist($mockUser);

                $note = new Note();
                $note
                    ->setMockUser($mockUser)
                    ->setGrade(rand(5, 20)/20)
                    ->setRule($rule)
                    ->setScale(20);
                $note->setUser($user);

                $manager->persist($note);
            }
        }
        $manager->flush();
    }
}
