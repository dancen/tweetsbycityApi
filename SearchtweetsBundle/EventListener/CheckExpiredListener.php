<?php

namespace Api\SearchtweetsBundle\EventListener;

use Api\SearchtweetsBundle\Event\FilterManagerEvent;
use Api\SearchtweetsBundle\Model\AppConstants;

/**
 * Api\SearchtweetsBundle\EventListener\CheckExpiredListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class CheckExpiredListener implements AppConstants {

    private $appmanager;
    private $event;
    private $content;

    public function __construct(FilterManagerEvent $event) {
        $this->event = $event;
        $this->content = $event->getRequest()->getContent();
        $this->appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
    }

    public function onProcess() {
                 
        // get the user stored in cookie from the event object         
        $user = $this->event->getData();

        // get the city from http parameters        
        $location = $this->event->getRequest()->get("city");        

        // get last info by user and location
        $lastinfo = $this->appmanager->getLastInfoDatetimeByUserAndLocation($user, $location);

        if ($lastinfo) {
            
            $lastinfodatetime = $lastinfo->getCreatedAt();
            // create the expire date object
            $expiryDate = new \DateTime('-1 hour');

            // compare objects
            if ($lastinfodatetime->getTimestamp() < $expiryDate->getTimestamp()) {

                // update the lastload data
                $tweet = $lastinfo;
                $tweet->setLastload(new \Datetime());
        
                // update the tweet object to database
                $this->appmanager->saveTweets($tweet);                
                
                $this->event->setResponse(false);                
                
                
            } else {

                $this->event->setResponse(true);
            }
            
        } else {
            
            $this->event->setResponse(true);
        }
    }
 }
    