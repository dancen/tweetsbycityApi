<?php

namespace Api\SearchtweetsBundle\Model;


/**
 *Api\SearchtweetsBundle\Model\ManagerFactory
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class ManagerFactory {
        
    /**
     * Get createAppManager
     * 
     * @param ContainerAware obect $container
     *
     * @return Api\SearchtweetsBundle\Model\AppManager
     */
    
    public function createAppManager( $container ) {        
        
        return $container->get('api_searchtweets.app_manager');
        
    }
       

     /**
     * Get createEntityManager
     *
     * @param ContainerAware obect $container
     *
     * @return Api\SearchtweetsBundle\Model\EntManager
     */
    
     public function createEntityManager( $container ) {        
        
        return $container->get('api_searchtweets.ent_manager');
        
     }
     
     
    

    

}
