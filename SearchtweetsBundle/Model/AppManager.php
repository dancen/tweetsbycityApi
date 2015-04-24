<?php

namespace Api\SearchtweetsBundle\Model;
use Api\SearchtweetsBundle\Model\AppConstants;
use Api\SearchtweetsBundle\Model\AppManagerInterface;


/**
 *Api\SearchtweetsBundle\Model\AppManager
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
abstract class AppManager extends Manager implements AppConstants , AppManagerInterface {
    

    /**
    * get all infos history stored by user
    * 
    * @param string $user
    * 
    * @abstract
    */
    
    abstract public function getInfosHistory($user);
    
    /**
    * get infos history row stored by id
    * 
    * @param string $id
    * 
    * @abstract
    */
    
    abstract public function getInfosById($id);
    
    /**
    * get last infos stored by user (cache)
    * 
    * @param string $user
    * @param string $location
    * 
    * @abstract
    */
    
    abstract public function getInfosByUser($user,$location);
  
    /**
    * get all infos datetime to check if cache has expired
    * 
    * @param string $user
    * @param string $location
    * 
    * @abstract
    */
    
    abstract public function getLastInfoDatetimeByUserAndLocation($user,$location);

    /**
    * save infos to db as cache
    * 
    * @param Api\SearchtweetsBundle\Tweet
    * 
    * @abstract
    */
    
    abstract public function saveTweets($tweet);
    
    
    /**
     * objToArray() 
     * utility method to convert an object
     * in an associative array
     * 
     * @param  Object
     * @return Array 
     */
    
    public function objToArray($object) {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }
    
    
      
}