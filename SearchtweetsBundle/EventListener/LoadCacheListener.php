<?php

namespace Api\SearchtweetsBundle\EventListener;

use Api\SearchtweetsBundle\Event\FilterManagerEvent;
use Api\SearchtweetsBundle\Model\AppConstants;

/**
 * Api\SearchtweetsBundle\EventListener\GetOrdersListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class LoadCacheListener implements AppConstants {

    private $appmanager;
    private $event;
    private $content;

    public function __construct(FilterManagerEvent $event) {
        $this->event = $event;
        $this->content = $event->getRequest()->getContent();
        $this->appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
    }

    public function onProcess(){      
        
      
        // get the request http object        
        $location = $this->event->getRequest()->get("city");                
        
        // get the user stored in cookie from the event object
        $user = $this->event->getData();       
        
        // get infos from cache
        $lastinfo = $this->appmanager->getInfosByUser($user,$location);        
        
        $this->event->setResponse($lastinfo); 
        
    }

}
