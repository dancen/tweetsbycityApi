<?php

namespace Api\SearchtweetsBundle\EventListener;

use Api\SearchtweetsBundle\Event\FilterManagerEvent;
use Api\SearchtweetsBundle\Model\AppConstants;

/**
 * Api\SearchtweetsBundle\EventListener\GetLocationListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class GetLocationDataListener implements AppConstants {
    
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
             
       
        // get lat lng from ip-address
        $contents = @file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
        
        $ip_data = @json_decode($contents);
        
        $lat = $ip_data->geoplugin_latitude;
        
        $lng = $ip_data->geoplugin_longitude;
        
        $location_data = @file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=false");
        
        $this->event->setResponse($location_data);
       
    }
    
    
   
        
   

}
