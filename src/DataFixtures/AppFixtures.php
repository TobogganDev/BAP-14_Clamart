<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\Ranking;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
	private UserPasswordHasherInterface $hasher;
	public function __construct(UserPasswordHasherInterface $hasher)
	{
		$this->hasher = $hasher;
	}
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
				$admin->setEmail('admin@localhost');
	      $admin->setRoles(['ROLE_ADMIN']);
	      $password = $this->hasher->hashPassword($admin, 'admin');
	      $admin->setPassword($password);
	      $admin->setName('admin');
	      $manager->persist($admin);

        $manager->flush();
				
				$user = new User();
				$user->setEmail('user@localhost');
	      $user->setRoles(['ROLE_USER']);
	      $password = $this->hasher->hashPassword($user, 'user');
	      $user->setPassword($password);
	      $user->setName('user');
	      $manager->persist($user);

				$manager->flush();
				
				for ($i = 0; $i < 10; $i++) {
					$question = new Question();
					$question->setTitle('Question ' . $i);
					$question->setRightAnswer(1);
					$question->setVisible(true);
					$question->setAnswers(['test1', 'test2', 'test3', 'test4']);
					$manager->persist($question);
				}
				
				$manager->flush();
				
				for ($i = 0; $i < 10; $i++) {
					$rank = new Ranking();
					$rank->setName('Ranking'.$i);
					$rank->setScore(10);
					$manager->persist($rank);
				}
				
				$manager->flush();
    }
}
