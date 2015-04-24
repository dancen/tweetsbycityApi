<?php

namespace Api\SearchtweetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Api\SearchtweetsBundle\Tweet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Api\SearchtweetsBundle\Entity\TweetRepository")
 */
class Tweet {

    /**
     * @var bigint $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $user
     *
     * @ORM\Column(name="user", type="string", length=100, nullable=false)
     */
    protected $user;
    
    
    /**
     * @var string $infos
     *
     * @ORM\Column(name="infos", type="text", nullable=false)
     */
    protected $infos;
    
    
    /**
     * @var string $location
     *
     * @ORM\Column(name="location", type="string", length=100, nullable=false)
     */
    protected $location;
    
    
    /**
     * @var date $created_at
     *
     * @ORM\Column(name="created_at",  type="datetime", nullable=false)
     */
    private $created_at;
    
    /**
     * @var date $lastload
     *
     * @ORM\Column(name="lastload",  type="datetime", nullable=false)
     */
    private $lastload;

    
    /**
     * Constructor
     */
    public function __construct( $user )
    {
       $this->user = $user;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Tweet
     */
    public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set infos
     *
     * @param string $infos
     * @return Tweet
     */
    public function setInfos($infos)
    {
        $this->infos = $infos;
    
        return $this;
    }

    /**
     * Get infos
     *
     * @return string 
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Tweet
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Tweet
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set lastload
     *
     * @param \DateTime $lastload
     * @return Tweet
     */
    public function setLastload($lastload)
    {
        $this->lastload = $lastload;
    
        return $this;
    }

    /**
     * Get lastload
     *
     * @return \DateTime 
     */
    public function getLastload()
    {
        return $this->lastload;
    }
}