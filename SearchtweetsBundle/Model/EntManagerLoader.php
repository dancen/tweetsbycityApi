<?php

namespace Api\SearchtweetsBundle\Model;
use Api\SearchtweetsBundle\Model\AppConstants;
/**
 *Api\SearchtweetsBundle\Model\EntManager
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class EntManagerLoader implements AppConstants {        

  /**
    * bridge class load a repository from entity manager ( doctrine , propel ... etc)
    */    
    
    private $entity_manager;    
    
    public function __construct( $entity_manager ) {
        $this->entity_manager = $entity_manager;
    }    
    
    public function init( $bundle = null ){
        if($bundle){ $this->bundle = $bundle; }
    }
      
    public function exec( $command , $entity , $parameters = null ) {
        $repository = $this->entity_manager->getRepository(AppConstants::BUNDLE.":".$entity);
        $result = $repository->$command( $parameters );
        return $result;
    }
    
    public function getEntityManager(){
        return $this->entity_manager;
    } 
    
   
    

   
    

}
