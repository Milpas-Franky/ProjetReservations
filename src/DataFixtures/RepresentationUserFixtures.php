<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\RepresentationUser;

class RepresentationUserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
		$representationUser = [
            [
                'user_firstname'=>'daniel',
                'user_lastname'=>'kabo',
                'titre'=>'ayiti',
				'date'=>'2012-10-12 13:30',
				'places'=>'2',
            ],
            [
                'user_firstname'=>'julien',
                'user_lastname'=>'marco',
                'titre'=>'ayiti',
				'date'=>'2012-10-12 20:30',
				'places'=>'4',
            ],
            [
                'user_firstname'=>'stephane',
                'user_lastname'=>'capone',
                'titre'=>'cible-mouvante',
				'date'=>'2012-10-02 20:30',
				'places'=>'6',
            ],
            [
                'user_firstname'=>'alain',
                'user_lastname'=>'wetu',
                'titre'=>'ceci-n-est-pas-un-chanteur-belge',
				'date'=>'2012-10-16 20:30',
				'places'=>'8',
            ],
			        ];
				foreach ($representationUser as $record) {
					     
						 //Assigner la référence du user correspondant
                        $user=$this->getReference(
                        $record['user_firstname'].'-'.$record['user_lastname']);
                        //Assigner la référence de la représentation correspondante
                        $representation=$this->getReference($record['titre'].'-'.$record['date']);
						$at = new RepresentationUser();
						$at->setUser($user);
                        $at->setRepresentation($representation);
						$at->setPlaces($record['places']);
						//Définir sa representation
                        $user->addReservation($at);
		$this->setReference($record['user_firstname'].'-'.$record['user_lastname'].'-'.$record['titre'].'-'.$record['date'],$at);
                       //Persister l'entité principale
                        $manager->persist($at);        
  				
                       }	
                        $manager->flush();
    }
	     public function getDependencies() {
        return [
            RepresentationFixtures::class,
            UserFixtures::class,
        ];
    }
}
