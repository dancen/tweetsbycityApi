<?php

namespace Api\SearchtweetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Api\SearchtweetsBundle\ApiSearchtweetsEvents;
use Api\SearchtweetsBundle\Model\AppConstants;

class DefaultController extends Controller {
    
    
    
    /**
     * indexAction() 
     *
     * this action return the version and the author of
     * the application and any other info users should
     * know about the rest service
     * 
     * @param  void
     * @return json 
     */

    public function indexAction() {

        $response = new Response(json_encode(array(
                    "application" => "SearchTweets Api 1.0",
                    "release date" => "Apr 2015",
                    "author" => "Daniele Centamore",
                    "contact" => "daniele.centamore@gmail.com"
        )));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    
    

    /**
     * searchAction() 
     *
     * this action is the main action and is
     * responsible of the main business logic.
     * first check the user cookie, if the
     * cookie not found will be performed
     * the first search/tweeter and the event INIT_USER
     * set the new user cookie. In case the cookie
     * is present will be executed the expire cache
     * checking. If the searching is older than
     * 1 hour a new tweeter search will be performed
     * and tweets will be saved in database as cache
     * 
     * @param  void
     * @return json 
     */
    
    public function searchAction() {

        // get the cookie data from the client       
        $request = $this->get('request');
        $cookies = $request->cookies;
        $user = $cookies->get(AppConstants::USER_NAME_COOKIE);
        
               
        

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        $event = $this->get('api_searchtweets.filter_manager_event');


        // if the user is not found as a cookie value
        // the first search will be performed and the 
        // results will be saved in database as a new user 

        if (!$user) {

            

            // perform the first search
            $dispatcher->dispatch(ApiSearchtweetsEvents::SERVICE_SEARCH);

            // init the new user              
            $dispatcher->dispatch(ApiSearchtweetsEvents::INIT_USER);
        } else {

            

            // the search will be checked in database
            // if the last search by city is not expired (1 hour)
            // the data will be returned from database
            // oherwise a new serch will be performed
            // check if the search is expired 
            
            $event->setData($user);
            $dispatcher->dispatch(ApiSearchtweetsEvents::CHECK_EXPIRED);
            $isexpired = $event->getResponse();


            if (!$isexpired) {
                
                

                // not expired - load from cache                    
                $dispatcher->dispatch(ApiSearchtweetsEvents::SERVICE_LOAD_CACHED);
            } else {
                
                

                // expired - perform a new search                   
                $dispatcher->dispatch(ApiSearchtweetsEvents::SERVICE_SEARCH);
                $event->setData(array_merge($event->getData(), array("user" => $user)));
                $dispatcher->dispatch(ApiSearchtweetsEvents::SAVE_CACHE);
            }
        }

        $response = new Response($event->getResponse());
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }

    
    
    
   /**
     * historyAction() 
     *
     * this action return id, city and date
     * of last search performed by the user
     * the user is identify by the client 
     * cookie 
     * 
     * @param  void
     * @return json 
     */
    
    public function historyAction() {

        // get the cookie data from the client       
        $request = $this->get('request');
        $cookies = $request->cookies;
        $user = $cookies->get(AppConstants::USER_NAME_COOKIE);
        
        
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        $event = $this->get('api_searchtweets.filter_manager_event');

        if ($user) {
           
            // if user not null retrieve the history of last 20 
            // search performed group by city from database  
            
            $event->setData($user);
            $dispatcher->dispatch(ApiSearchtweetsEvents::SERVICE_HISTORY);
            $response = new Response(json_encode($event->getResponse()));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } else {

            $response = new Response(json_encode(array("response" => "no data")));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }
    }
    
    
    
    
    /**
     * loadTweetsAction() 
     *
     * this action return tweets stored in
     * database of the search performed
     * this action is invoked by clicking
     * from the history page
     * 
     * @param  $id primary id
     * @return json 
     */
    
    public function loadTweetsAction($id) {

        // get the cookie data from the client       
        $request = $this->get('request');
        $cookies = $request->cookies;
        $user = $cookies->get(AppConstants::USER_NAME_COOKIE);
        
        
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        $event = $this->get('api_searchtweets.filter_manager_event');

        if ($user) {
           
            // if user not null retrieve the tweets by id
            // otherwise return json no data response
            
            $event->setData($id);
            $dispatcher->dispatch(ApiSearchtweetsEvents::LOAD_HISTORY);
            $resp = $event->getResponse();
            
            $response = new Response(json_encode($resp[0]["infos"]));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } else {

            $response = new Response(json_encode(array("response" => "no data")));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }
    }
    
    
    
    /**
     * locationDataAction() 
     *
     * this action return geolocation
     * data in order to set the initial 
     * city. Data are fetched by two
     * services: http://www.geoplugin.net/json.gp
     * and http://maps.googleapis.com/maps/api/geocode/json?
     * working together
     * 
     * @param  void
     * @return json 
     */
    
    
    public function locationDataAction() {

        
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        $event = $this->get('api_searchtweets.filter_manager_event');
        $dispatcher->dispatch(ApiSearchtweetsEvents::LOCATION_DATA);
        $response = new Response(json_encode($event->getResponse()));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
    
    

}
