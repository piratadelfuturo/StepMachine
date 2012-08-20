<?php
namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity()
 * @ORM\Table(name="activity")
 * @ORM\HasLifecycleCallbacks
 */
class Activity extends DomainObject{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Boom", inversedBy="activities" )
     */
    protected $boom;

    /**
     * @ORM\ManyToOne(targetEntity="user", inversedBy="activities" )
     */
    protected $user;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="array")
     */
    protected $data;



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
     * Set date
     *
     * @param datetime $date
     * @return Activity
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set data
     *
     * @param array $data
     * @return Activity
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set boom
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $boom
     * @return Activity
     */
    public function setBoom(\Boom\Bundle\LibraryBundle\Entity\Boom $boom = null)
    {
        $this->boom = $boom;
        return $this;
    }

    /**
     * Get boom
     *
     * @return Boom\Bundle\LibraryBundle\Entity\Boom
     */
    public function getBoom()
    {
        return $this->boom;
    }

    /**
     * Set user
     *
     * @param Boom\Bundle\LibraryBundle\Entity\user $user
     * @return Activity
     */
    public function setUser(\Boom\Bundle\LibraryBundle\Entity\user $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Boom\Bundle\LibraryBundle\Entity\user
     */
    public function getUser()
    {
        return $this->user;
    }
}