<?php

namespace App\Repository;

use App\Entity\Louer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Louer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Louer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Louer[]    findAll()
 * @method Louer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LouerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Louer::class);
    }
    public function getAllLouer(){ 
        $conn = $this->getEntityManager()->getConnection();
        $query = 'SELECT louer.id,locataire.nom as nom_locataire , 
        voiture.design as nom_voiture ,
        nbr_jour,
        date_location
        FROM `louer`
        INNER JOIN locataire on louer.locataire_id = locataire.id 
        INNER join voiture on louer.voiture_id = voiture.id';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findFactureVoiture($id){ 
        $conn = $this->getEntityManager()->getConnection();
        $query = 'SELECT louer.id as louer_id ,locataire.nom as nomLocataire , 
        voiture.id as voiture_id, voiture.design as designation ,
        voiture.loyer as loyer , nbr_jour, Sum(nbr_jour*voiture.loyer) as total_kely 
        FROM `louer`
        INNER JOIN locataire on louer.locataire_id = locataire.id 
        INNER join voiture on louer.voiture_id = voiture.id 
        WHERE voiture.id = :id 
        group by voiture.id,nbr_jour';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(); 
    }

    public function findFactureTotal($id){ 
        $conn = $this->getEntityManager()->getConnection();
        $query = 'SELECT  
        Sum(nbr_jour*voiture.loyer) as total 
        FROM `louer`
        INNER JOIN locataire on louer.locataire_id = locataire.id 
        INNER join voiture on louer.voiture_id = voiture.id 
        WHERE voiture.id = :id';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(); 
    }

    public function findMoneyTotal(){ 
        $conn = $this->getEntityManager()->getConnection();
        $query = 'SELECT voiture.id as voiture_id,
        Sum(nbr_jour*voiture.loyer) as total ,
        COUNT(locataire.id) as effectif
        FROM `louer`
        INNER JOIN locataire on louer.locataire_id = locataire.id 
        INNER join voiture on louer.voiture_id = voiture.id 
        GROUP by voiture.id';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(); 
    }

}
