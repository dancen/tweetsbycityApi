<?php

namespace Api\SearchtweetsBundle\Event;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Api\SearchtweetsBundle\Model\ManagerFactory;

class FilterManagerEvent extends Event
{
    private $container;
    private $manager_factory;
    private $request;
    private $response;
    private $session;
    private $data;
    private $status;
    private $message;

    public function __construct(ContainerInterface $container, ManagerFactory $manager_factory) {

        $this->manager_factory = $manager_factory;
        $this->container = $container;
        $this->request = $container->get('request');
        $this->session = $container->get('request')->getSession();     

    }    

    /**
     * @return Symfony\Component\DependencyInjection\ContainerInterface;
     */
    public function getContainer()
    {
        return $this->container;
    }

   
    /**
     * @return request
     */
    public function getRequest()
    {
        return $this->request;
    }
    
    /**
     * Set request
     *
     * @param Object $request
     */
    public function setRequest( $request )
    {
        $this->request = $request;
    }
    
    /**
     * @return session
     */
    public function getSession()
    {
        return $this->session;
    }
    
    /**
     * Set session
     *
     * @param Object $session
     */
    public function setSession( $session )
    {
        $this->session = $session;
    }
    
    
    
    
    /**
     * @return Api\SearchtweetsBundle\Model\ManagerFactory
     */
    public function getManagerFactory()
    {
        return $this->manager_factory;
    }
    
    
    
    /**
     * Set response
     *
     * @param Object $response
     */
    public function setResponse( $response )
    {
        $this->response = $response;
    }
    
    /**
     * @return user
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    /**
     * @return Symfony\Component\EventDispatcher
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }
    
    /**
     * Set data
     *
     * @param Object $data
     */
    public function setData( $data )
    {
        $this->data = $data;
    }
    
    /**
     * @return data
     */
    public function getData()
    {
        return $this->data;
    }
    
     /**
     * Set status
     *
     * @param Object $status
     */
    public function setStatus( $status )
    {
        $this->status = $status;
    }
    
    /**
     * @return status
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    
     /**
     * Set message
     *
     * @param Object $message
     */
    public function setMessage( $message )
    {
        $this->message = $message;
    }
    
    /**
     * @return status
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    
    
}
