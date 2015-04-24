<?php

namespace Api\SearchtweetsBundle\EventListener;

use Api\SearchtweetsBundle\Event\FilterManagerEvent;
use Api\SearchtweetsBundle\Model\AppConstants;
use Api\SearchtweetsBundle\Model\AppFactory;

/**
 * Api\SearchtweetsBundle\EventListener\SaveTweetsListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class SaveTweetsListener implements AppConstants {
    
    private $appmanager;
    private $event;
    private $content;
   
    public function __construct(FilterManagerEvent $event)
    {
        $this->event = $event;
        $this->content = $event->getRequest()->getContent();
        $this->appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
    }
    
     public function onProcess() {  
                 
        // get the user stored in cookie from the event object
        $data = $this->event->getData();
        
       
       
        // create a new Tweet entity        
        $tweet = AppFactory::createTweet($data["user"]);
        $tweet->setLocation(strtolower($data["city"]));
        $tweet->setInfos($data["tweets"]);
        $tweet->setCreatedAt(new \Datetime());
        $tweet->setLastload(new \Datetime());
        
        // save the tweet object to database
        $this->appmanager->saveTweets($tweet);
        
    }
    
   
        
   

}
