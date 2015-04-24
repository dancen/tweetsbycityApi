<?php

namespace Api\SearchtweetsBundle\EventListener;

use Api\SearchtweetsBundle\Event\FilterManagerEvent;
use Api\SearchtweetsBundle\Model\AppConstants;
use Api\SearchtweetsBundle\Model\AppFactory;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api\SearchtweetsBundle\EventListener\InitUserListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class InitUserListener implements AppConstants {
    
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
         
        // get data in event object
        $data = $this->event->getData();
                       
        // generate a random user name
        $user = md5(uniqid(rand(), true));        
        
        // create the cookie to retrieve the history by user
        $cookie = AppFactory::createCookie(AppConstants::USER_NAME_COOKIE, $user);
        
        // create a new Tweet entity        
        $tweet = AppFactory::createTweet($user);
        $tweet->setLocation(strtolower($data["city"]));
        $tweet->setInfos($data["tweets"]);
        $tweet->setCreatedAt(new \Datetime());
        $tweet->setLastload(new \Datetime());
        
        // save the tweet object to database
        $this->appmanager->saveTweets($tweet);
        
        $response = new Response();
        $response->headers->setCookie($cookie);
        $response->send();  
        
        
    }
    

    

}
