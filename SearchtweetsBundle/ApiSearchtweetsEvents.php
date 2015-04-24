<?php

namespace Api\SearchtweetsBundle;

/**
 * Api\SearchtweetsBundle\ApiSearchtweetsEvents
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */

final class ApiSearchtweetsEvents
{
       
    
    
    /**
     * The LOCATION_DATA event occurs when the user session is initialized.
     *
     * This event get initial location data by ip address of the user
     * The event listener method receives a Api\SearchtweetsBundle\Event\FilterManagerEvent instance.
     */
    const LOCATION_DATA = 'location.data';
    
    /**
     * The CHECK_EXPIRED event occurs when the user search for service.
     *
     * This event check if seraching data is cached in db and not expired (1 hour)
     * The event listener method receives a Api\SearchtweetsBundle\FilterManagerEvent instance.
     */
    const CHECK_EXPIRED = 'check.expired';
    
    /**
     * The SERVICE_LOAD_CACHED event occurs 
     *
     * This event load cached info from repository
     * The event listener method receives a Api\SearchtweetsBundle\Event\FilterManagerEvent instance.
     */
    const SERVICE_LOAD_CACHED = 'service.loadcached';
    
    /**
     * The SERVICE_HISTORY event occurs 
     *
     * This event load search history by user 
     * The event listener method receives a Api\SearchtweetsBundle\Event\FilterManagerEvent instance.
     */
    const SERVICE_HISTORY = 'service.history';
    
    
    /**
     * The SERVICE_SEARCH event occurs 
     *
     * This event search the last 20 tweets by city 
     * The event listener method receives a Api\SearchtweetsBundle\Event\FilterManagerEvent instance.
     */
    const SERVICE_SEARCH = 'service.search';
    
    
    /**
     * The SAVE_CACHE event occurs
     *
     * This event save cache info data into repository
     * The event listener method receives a Api\SearchtweetsBundle\Event\FilterManagerEvent instance.
     */
    const SAVE_CACHE = 'save.cache';
    
    
    /**
     * The LOAD_HISTORY event occurs
     *
     * This event load a sigle search data row from database
     * The event listener method receives a Api\SearchtweetsBundle\Event\FilterManagerEvent instance.
     */
    const LOAD_HISTORY = 'load.history';
    
    
    
    
}