<?php

namespace App\DataFixtures;

use App\Entity\FlashCards;
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
	
	
				$flashCard = ['La proportion du flux de données du streaming vidéo sur internet' => "60%.  Le streaming vidéo est une activité gourmande en bande passante et représente une part importante des flux de données sur Internet. En raison de la quantité de données échangées lors du streaming, il a un impact environnemental considérable en termes de consommation d'énergie et d'émissions de CO2.", 'Lutter contre la pollution numérique' => "Utiliser moins d'objets informatiques et les faire durer plus longtemps. En utilisant moins d'objets électroniques et en prolongeant leur durée de vie, on réduit la demande de nouvelles ressources pour la production et on diminue la quantité de déchets électroniques générés. Cela contribue à réduire l'impact environnemental global de la pollution numérique.", "Pourquoi la production d'un téléviseur est-elle coûteuse en termes d'impact environnemental ?" => "Elle nécessite l'extraction de 2,5 tonnes de matières premières et génère 350 kg de CO₂. La production d'un téléviseur est coûteuse en termes d'impact environnemental car elle nécessite l'extraction de grandes quantités de matières premières et engendre des émissions de CO2 importantes. Cela met en évidence l'importance de la durabilité et de l'économie circulaire dans la réduction de la pollution numérique.", "Quel est l'un des problèmes liés à l'extraction des minerais pour la production d'équipements électroniques ?" => "Pollution des écosystèmes et drames humains liés à l'activité minière. L'extraction des minerais pour la production d'équipements électroniques a des conséquences néfastes sur l'environnement et les communautés locales. Les écosystèmes sont souvent détruits ou pollués, et les travailleurs du secteur minier peuvent être confrontés à des conditions de travail dangereuses et inhumaines.", " Quel est l'impact du déploiement de la 5G sur la pollution numérique ?" => "Aggravation de la pollution numérique. Bien que la 5G offre des avantages en termes de vitesse et de capacité, son déploiement entraîne également une augmentation de la consommation d'énergie et des émissions de gaz à effet de serre. La construction de nouvelles infrastructures et la mise à niveau des équipements existants contribuent à accroître l'impact environnemental de la pollution numérique.", "Comment peut-on prolonger la durée de vie des équipements et terminaux numériques ?" => "Ne changer de smartphone que lorsqu'il n'est plus fonctionnel. En prolongeant la durée de vie des équipements et terminaux numériques, on réduit la demande de nouvelles ressources pour la production et on diminue la quantité de déchets électroniques générés. Cela contribue à réduire l'impact environnemental global de la pollution numérique.", "Quelle est l'une des recommandations pour réduire son empreinte numérique environnementale ?" => "Éteindre sa box internet lorsqu'on est absent ou la nuit. Éteindre sa box internet lorsqu'elle n'est pas utilisée permet de réduire la consommation d'énergie et les émissions de CO2 associées. Adopter des habitudes éco-responsables comme celle-ci permet de limiter notre impact environnemental.", "Qu'est-ce qui fait que l'utilisation de Google pour effectuer des recherches a un impact environnemental ?" => "Le temps de recherche et le nombre de pages consultées. Lorsque vous effectuez une recherche sur Google, l'information doit passer par plusieurs data centers, ce qui consomme de l'énergie. Plus le temps de recherche est long et plus vous consultez de pages, plus l'impact environnemental est important.", "Combien de grammes de CO2 sont émis pour une recherche sur Google ?" => "7 grammes. Un chercheur de Harvard, M. Wissner-Gross, estime qu'une recherche sur Google émet 7 grammes de CO2. Cette quantité peut sembler faible, mais compte tenu du nombre de recherches effectuées quotidiennement, l'impact cumulé est considérable", "Quel pourcentage d'émissions de gaz à effet de serre dans le domaine du numérique est lié aux objets connectés ?" => "39 %. Les objets connectés, tels que les téléphones, les écouteurs, les montres, les box Internet, les assistants virtuels et les ordinateurs, émettent 39 % des émissions de gaz à effet de serre dans le domaine du numérique. Leur utilisation et leur fabrication sont très énergivores, et leur gestion en fin de vie est également problématique en termes d'émissions de gaz à effet de serre.", "Quelle proportion des objets connectés est recyclée ?" => " Seuls 5 % des objets connectés sont recyclés, alors que leur fabrication nécessite des ressources naturelles non renouvelables et qu'ils contiennent des composants dangereux. Le faible taux de recyclage des objets connectés souligne la nécessité d'améliorer les pratiques de gestion des déchets électroniques et de promouvoir une consommation plus responsable.
", "Que recommande-t-on pour réduire son empreinte carbone lors de l'utilisation d'Internet ?" => "Utiliser un moteur de recherche respectueux de l'environnement comme Ecosia permet de réduire son empreinte carbone en ligne. Ecosia utilise une partie de ses revenus pour planter des arbres, contribuant ainsi à la lutte contre la déforestation et le changement climatique. Cela contraste avec d'autres moteurs de recherche qui consomment beaucoup d'énergie et ont un impact environnemental plus élevé.", "Quel pourcentage de Français préfère les entreprises respectueuses de l'environnement ?" => "Selon l'article, 80 % des Français préfèrent les entreprises respectueuses de l'environnement. Cela montre l'importance croissante de la durabilité et de la responsabilité environnementale pour les consommateurs. Les entreprises qui adoptent des pratiques écologiques et respectueuses de l'environnement sont donc susceptibles d'attirer davantage de clients et de renforcer leur réputation."];
				
	    foreach ($flashCard as $item => $desc){
				$flash = new FlashCards();
				$flash->setTitle($item);
				$flash->setDescription($desc);
				$manager->persist($flash);
	    }
			
			$manager->flush();
    }
}
