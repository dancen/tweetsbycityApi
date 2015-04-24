<?php

namespace Api\SearchtweetsBundle\EventListener;

use Api\SearchtweetsBundle\Event\FilterManagerEvent;
use Api\SearchtweetsBundle\Model\AppConstants;
use Api\SearchtweetsBundle\Model\AppFactory;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api\SearchtweetsBundle\EventListener\ServiceSearchListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class ServiceSearchListener implements AppConstants {

    private $appmanager;
    private $event;
    private $content;
    private $container;

    public function __construct(FilterManagerEvent $event) {
        $this->event = $event;
        $this->container = $event->getContainer();
        $this->content = $event->getRequest()->getContent();
        $this->appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
    }

    public function onProcess() {

        // get the request http object        
        $city = $this->event->getRequest()->get("city");
        $lat = $this->event->getRequest()->get("lat");
        $lng = $this->event->getRequest()->get("lng");
        
        // set authentication parameters
        $settings = array(
            'oauth_access_token' => $this->container->getParameter("oauth_access_token"),
            'oauth_access_token_secret' => $this->container->getParameter("oauth_access_token_secret"),
            'consumer_key' => $this->container->getParameter("consumer_key"),
            'consumer_secret' => $this->container->getParameter("consumer_secret"),
        );

        // get the max number of tweets - set as parameter
        $count = $this->container->getParameter("max_tweets_returned");

        // set the searc/tweets url and query
        $url = "https://api.twitter.com/1.1/search/tweets.json";
        $query = "?q=" . urlencode($city) . "&geocode=" . $lat . "," . $lng . ",50mi&result_type=recent";
        //&count=".$count;
        
        // execute the Twitter calls
        $requestMethod = 'GET';
        $twitter = AppFactory::createTwitterApi($settings);
        $twitters = $twitter->setGetfield($query)
                ->buildOauth($url, $requestMethod)
                ->performRequest();

        
        $this->event->setData(array("city" => $city,"tweets" => $twitters));
        $this->event->setResponse($twitters);        
        
    }

}
