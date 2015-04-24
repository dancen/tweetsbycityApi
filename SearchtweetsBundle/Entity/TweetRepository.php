<?php

namespace Api\SearchtweetsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TweetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TweetRepository extends EntityRepository
{
    public function getInfosByUser( $user , $loc ) {
        return $this->getEntityManager()
                ->createQuery("SELECT a FROM ApiSearchtweetsBundle:Tweet a WHERE a.user='".$user."' AND a.location='".$loc."' ORDER BY a.created_at DESC")
                ->setMaxResults(1)
                ->getResult();
    }
    
    public function getInfosHistory( $user ) {
        return $this->getEntityManager()
                ->createQuery("SELECT a.id,a.location,a.created_at FROM ApiSearchtweetsBundle:Tweet a WHERE a.user='".$user."' ORDER BY a.lastload DESC")
                ->setMaxResults(20)
                ->getResult();
    }
    
    public function getLastInfoByUserAndLocation( $user , $loc ) {
        return $this->getEntityManager()
                ->createQuery("SELECT a FROM ApiSearchtweetsBundle:Tweet a WHERE a.user='".$user."' AND a.location='".$loc."' ORDER BY a.created_at DESC")
                ->setMaxResults(1)
                ->getResult();
    }
    
    public function getInfoById( $id ) {
        return $this->getEntityManager()
                ->createQuery("SELECT a.infos FROM ApiSearchtweetsBundle:Tweet a WHERE a.id='".$id."'")
                ->setMaxResults(1)
                ->getResult();
    }
}
