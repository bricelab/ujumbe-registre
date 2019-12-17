<?php
/**
 * @author bricelab <bricehessou@gmail.com>
 * @version 0.1
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Classeur;
use App\Entity\Correspondant;
use App\Entity\CourrierArrive;
use App\Entity\CourrierDepart;
use App\Entity\Registre;
use App\Entity\Secretariat;
use App\Entity\TypeCourrier;
use App\Repository\CategoryRepository;
use App\Repository\ClasseurRepository;
use App\Repository\CorrespondantRepository;
use App\Repository\TypeCourrierRepository;
use App\Utils\Enum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    private $correspondantRepository;
    private $categoryRepository;
    private $typeCourrierRepository;
    private $classeurRepository;

    public function __construct(CorrespondantRepository $correspondantRepository, 
                                CategoryRepository $categoryRepository, 
                                TypeCourrierRepository $typeCourrierRepository,
                                ClasseurRepository $classeurRepository)
    {
        $this->correspondantRepository = $correspondantRepository;
        $this->categoryRepository = $categoryRepository;
        $this->typeCourrierRepository = $typeCourrierRepository;
        $this->classeurRepository = $classeurRepository;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create("fr_FR");

        $typeOrdinaire = (new TypeCourrier())
        ->setLibelle("Ordinaire")
        ;
        $manager->persist($typeOrdinaire);

        $typeConfidentiel = (new TypeCourrier())
        ->setLibelle("Confidentiel")
        ->setDescription("Très secret")
        ;
        $manager->persist($typeConfidentiel);

        //$manager->flush();


        $category1 = (new Category())
        ->setLibelle("Facture")
        ;
        $manager->persist($category1);

        $category2 = (new Category())
        ->setLibelle("Invitation")
        ;
        $manager->persist($category2);

        $category3 = (new Category())
        ->setLibelle("Lettre")
        ;
        $manager->persist($category3);

        //$manager->flush();

        $nbcorrespondant = random_int(50, 150);
        $index = [0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1];
        for($i=0; $i<$nbcorrespondant; $i++){
            $ind = $faker->randomElement($index);
            if($ind){
                $correspondant = (new Correspondant())
                ->setNomComplet($faker->company)
                ->setAdresse($faker->address)
                ->setEmail($faker->companyEmail)
                ->setVille($faker->city)
                ->setPays($faker->country)
                ->setCodePostal($faker->postcode)
                //->addSecretariat($secreatriat)
            ;
            }else {
                $correspondant = (new Correspondant())
                ->setNomComplet($faker->name())
                ->setAdresse($faker->address)
                ->setEmail($faker->freeEmail)
                ->setVille($faker->city)
                ->setPays($faker->country)
                ->setCodePostal($faker->postcode)
                //->addSecretariat($secreatriat)
                ;
            }
            
            $manager->persist($correspondant);
        }

        $manager->flush();

        $nbsecreatriat = random_int(5, 10);

        for($i=0; $i<$nbsecreatriat; $i++){            
            $secreatriat = (new Secretariat())
                ->setNom($faker->company)
                ->setSigle($faker->companySuffix)
                ->setDescription($faker->sentences($faker->numberBetween(3,10), true))
                //->addCorrespondant($leCorrespondant)
            ;

            
            $nbclasseurs = random_int(3, 10);
            for($j=0; $j<$nbclasseurs; $j++){
                $classeur = (new Classeur())
                ->setLibelle($faker->words($faker->numberBetween(3,4), true))
                ->setDescription($faker->sentences($faker->numberBetween(3,10), true))
                ->setSecretariat($secreatriat)
                ;
                $manager->persist($classeur);
            }
            //$id = $secreatriat->getId();
            $nbregistres = random_int(10, 30);

            for($k=0; $k<$nbregistres; $k++){
                $registre = (new Registre())
                ->setNumero($faker->randomNumber($faker->numberBetween(3,4), true))
                ->setNom($faker->words($faker->numberBetween(3,4), true))
                ->setDescription($faker->sentences($faker->numberBetween(3,10), true))
                ->setSecretariat($secreatriat)
                ;
                //dd($registre);

                $numStatus = random_int(1,5);
                switch ($numStatus) {
                    case 1:
                        $registre->setStatus(Enum::REGISTRE_STATUS_ARCHIVED);
                        break;
                    
                    case 2:
                        $registre->setStatus(Enum::REGISTRE_STATUS_CLOSED);
                        break;
                    
                    case 3:
                        $registre->setStatus(Enum::REGISTRE_STATUS_DELECTED);
                        break;
                    
                    case 4:
                        $registre->setStatus(Enum::REGISTRE_STATUS_OPENED);
                        break;
                    
                    case 5:
                        $registre->setStatus(Enum::REGISTRE_STATUS_TRASHED);
                        break;
                    
                    default:
                        break;
                }

                $numType = random_int(1,2);
                if ($numType === 1) {
                    $registre->setType(Enum::REGISTRE_TYPE_INCOMING);
                } else {
                    $registre->setType(Enum::REGISTRE_TYPE_OUTCOMING);
                }

                $manager->persist($registre);


                $tousLesCorrespondants = $this->correspondantRepository->findAll();
                $tousLesCategories = $this->categoryRepository->findAll();
                $tousLesTypes = $this->typeCourrierRepository->findAll();
                $tousLesClasseurss = $this->classeurRepository->findAllBySecretariat($secreatriat);
                
                $nbCourriers = random_int(50, 100);

                for ($l=0; $l < $nbCourriers; $l++) { 
                    $laCategorie = $faker->randomElement($tousLesCategories);
                    $leType = $faker->randomElement($tousLesTypes);
                    $leClasseur = $faker->randomElement($tousLesClasseurss);
                    if ($registre->getType() === Enum::REGISTRE_TYPE_INCOMING) {
                        $leCorrespondant = $faker->randomElement($tousLesCorrespondants);
                        $courrier = (new CourrierArrive())
                        ->setChrono($faker->randomNumber(4, true))
                        ->setReference(implode("/", $faker->words($faker->numberBetween(3,4), false)))
                        ->setCourrierDate(new \DateTime($faker->date('Y-m-d', 'now')))
                        ->setObjet($faker->sentence($faker->numberBetween(6,15), true))
                        ->setReceivedAt(new \DateTime($faker->date('Y-m-d', 'now')))
                        ->setClasseur($leClasseur)
                        ->setRegistre($registre)
                        ->setCategory($laCategorie)
                        ->setSender($leCorrespondant)
                        ->setType($leType)
                        ;

                        $leCorrespondant->addSecretariat($secreatriat);
                        $manager->persist($leCorrespondant);
                    } else if ($registre->getType() === Enum::REGISTRE_TYPE_OUTCOMING){
                        $courrier = (new CourrierDepart())
                        ->setChrono($faker->randomNumber(4, true))
                        ->setReference(implode("/", $faker->words($faker->numberBetween(3,4), false)))
                        ->setCourrierDate(new \DateTime($faker->date('Y-m-d', 'now')))
                        ->setObjet($faker->sentence($faker->numberBetween(6,15), true))
                        ->setSendAt(new \DateTime($faker->date('Y-m-d', 'now')))
                        ->setClasseur($leClasseur)
                        ->setRegistre($registre)
                        ->setCategory($laCategorie)
                        ->setType($leType)
                        ;

                        $nbsenders = random_int(1, 10);
                        for ($m=0; $m < $nbsenders; $m++) { 
                            $leCorrespondant = $faker->randomElement($tousLesCorrespondants);
                            $courrier->addRecipient($leCorrespondant);
                            $leCorrespondant->addSecretariat($secreatriat);
                            $manager->persist($leCorrespondant);
                        }
                    }else {

                    }
                    $manager->persist($courrier);
                    
                }

                
                
            }

        }

        $manager->flush();
    }
}
