<?php

namespace Api\SearchtweetsBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Api\SearchtweetsBundle\Model\ManagerFactory;
use Api\SearchtweetsBundle\Model\EntManagerLoader;

/**
 *Api\SearchtweetsBundle\Model\Manager
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
abstract class Manager {

    protected $container;
    protected $security;
    protected $manager_factory;
    protected $em_loader;
    protected $user = null;    
    protected $request;    

    public function __construct(ContainerInterface $container, ManagerFactory $manager_factory, EntManagerLoader $emloader) {

        $this->manager_factory = $manager_factory;
        $this->container = $container;
        $this->em_loader = $emloader;
        $this->request = $container->get('request');       

    }
    
       
    

}
