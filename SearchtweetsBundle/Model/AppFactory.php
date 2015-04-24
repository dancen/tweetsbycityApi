<?php

namespace Api\SearchtweetsBundle\Model;

/**
 *Api\SearchtweetsBundle\Model\AppFactory
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class AppFactory {
    

    
    /**
     * createDatetime
     * 
     * @param void
     *
     * @return Datetime - now date
     */
    
    public static function createDatetime(){
        
        return new \Datetime("now");
    }    
       
    
    /**
     * createDatetimeToday
     * 
     * @param void
     *
     * @return DateTime - today date
     */
    
    public static function createDatetimeToday(){
        
        return new \DateTime("today");
    }    
    
    
    /**
     * createRedirectResponse
     * 
     * @param string $url
     *
     * @return Symfony\Component\HttpFoundation\RedirectResponse
     */
    
    public static function createRedirectResponse( $url ){
               
        return new \Symfony\Component\HttpFoundation\RedirectResponse( $url , 301 );
    }    
        
    
    /**
     * createResponse
     * 
     * @param void
     *
     * @return Symfony\Component\HttpFoundation\Response
     */
    
    public static function createResponse(){
                
        return new \Symfony\Component\HttpFoundation\Response();
    }
    
    
    /**
     * createJsonResponse
     * 
     * @param array $params
     * @param string $params
     *
     * @return Symfony\Component\HttpFoundation\Response
     */
    
    public static function createJsonResponse( $params ){
        
        return new \Symfony\Component\HttpFoundation\Response( $params );
    }
    
    
    /**
     * createCookie
     * 
     * @param string $name
     * @param string $value
     *
     * @return Symfony\Component\HttpFoundation\Cookie
     */
    
    public static function createCookie( $name, $value ){
        
        return new \Symfony\Component\HttpFoundation\Cookie( $name, $value , time() + (3600 * 48));
    }    
    
    
    /**
     * createTweet
     * 
     * @param string $user
     *
     * @return Api\SearchtweetsBundle\Entity\Tweet
     */
    
    public static function createTweet($user){
        
        return new \Api\SearchtweetsBundle\Entity\Tweet($user);
    }
    
    
    /**
     * createTwitterApi
     * 
     * @param array $settings
     *
     * @return Api\SearchtweetsBundle\Model\TwitterAPIExchange
     */
        
    public static function createTwitterApi($settings){
        
        return new \Api\SearchtweetsBundle\Model\TwitterAPIExchange($settings);
    }
    
         

}
