<?php

namespace Api\SearchtweetsBundle\EventListener;

use Api\SearchtweetsBundle\Event\FilterManagerEvent;
use Api\SearchtweetsBundle\Model\AppConstants;

/**
 * Api\SearchtweetsBundle\EventListener\DeleteOrderListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class GetHistoryListener implements AppConstants {

    private $appmanager;
    private $event;
    private $content;

    public function __construct(FilterManagerEvent $event) {
        $this->event = $event;
        $this->content = $event->getRequest()->getContent();
        $this->appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
    }

     public function onProcess(){   
        
        // get the user stored in cookie from the event object
        $user = $this->event->getData();
        
        // retrieve data from database
        $tweets = $this->appmanager->getInfosHistory($user);        
        
        $this->event->setResponse($tweets); 
        
    }

}
