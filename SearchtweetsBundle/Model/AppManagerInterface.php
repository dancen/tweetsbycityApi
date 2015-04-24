<?php

namespace Api\SearchtweetsBundle\Model;

/**
 * Api\SearchtweetsBundle\Model\AppManagerInterface
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
interface AppManagerInterface {

    /**
     * method all AppManager class must implement
     * 
     */
    public function getInfosByUser($user, $location);

    public function getInfosHistory($user);

    public function getLastInfoDatetimeByUserAndLocation($user, $location);

    public function saveTweets($tweet);

    public function getInfosById($id);
}
