<?php

namespace Api\SearchtweetsBundle\EventListener;

use Api\SearchtweetsBundle\Event\FilterManagerEvent;
use Api\SearchtweetsBundle\Model\AppConstants;

/**
 * Api\SearchtweetsBundle\EventListener\CloseTableListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class LoadHistoryListener implements AppConstants {
    
    private $appmanager;
    private $event;
    private $content;
   
    public function __construct(FilterManagerEvent $event)
    {
        $this->event = $event;
        $this->content = $event->getRequest()->getContent();
        $this->appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
    }

     public function onProcess(){  
        
               
         // get the user stored in cookie from the event object
        $id = $this->event->getData();
        
        // retrieve data from database
        $tweet = $this->appmanager->getInfosById($id);        
        
        $this->event->setResponse($tweet); 
        
    }

}
