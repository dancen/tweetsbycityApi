<?php

namespace Api\SearchtweetsBundle\Doctrine;
use Api\SearchtweetsBundle\Model\AppManager;


/**
 *Api\SearchtweetsBundle\Model\DoctrineAppManager
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class DoctrineAppManager extends AppManager {
    

    
    
    /**
    * get all infos history stored by user
    * 
    * @param string $user
    * 
    * @return array
    */    
    
    public function getInfosHistory($user) {        
        $repository = $this->em_loader->getEntityManager()->getRepository('ApiSearchtweetsBundle:Tweet');
        $infos = $repository->getInfosHistory($user);              
        if($infos){ return $infos; } else { return null; }
    }
    
    /**
     * Get getInfosByUser
     *
     * @return string (longtext)
     */
    
    /**
    * get infos history row stored by id
    * 
    * @param string $id
    * 
    * @abstract
    */   
    
    public function getInfosByUser($user,$location) {        
        $repository = $this->em_loader->getEntityManager()->getRepository('ApiSearchtweetsBundle:Tweet');
        $infos = $repository->getInfosByUser($user,$location);              
        if($infos){ return $infos[0]->getInfos(); } else { return null; }
    }
    
   
    /**
     * Get getLastInfoDatetimeByUserAndLocation
     *
     * @return \Datetime 
     */
    public function getLastInfoDatetimeByUserAndLocation($user,$location) {        
        $repository = $this->em_loader->getEntityManager()->getRepository('ApiSearchtweetsBundle:Tweet');
        $info = $repository->getLastInfoByUserAndLocation($user,$location);
              
        if($info){ return $info[0]; } else { return null; }
    }

    /**
     * saveInfo object to db o cache data
     *
     */
    public function saveTweets($tweets) {
        $this->em_loader->getEntityManager()->persist($tweets);
        $this->em_loader->getEntityManager()->flush();
    }
    
    /**
     * Get getInfosHistory
     *
     * @return array
     */
    public function getInfosById($id) {        
        $repository = $this->em_loader->getEntityManager()->getRepository('ApiSearchtweetsBundle:Tweet');
        $info = $repository->getInfoById($id);              
        if($info){ return $info; } else { return null; }
    }
    
    
   
    

}
