<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="gallery") 
 */
class Gallery {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $title;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Image", inversedBy="galleries")
     * @ORM\JoinTable(name="galleries_images",
     *      joinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="gallery_id", referencedColumnName="id")}
     *      )
     */
    protected $images;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * */
    protected $user;

    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Gallery
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add images
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Image $images
     * @return Gallery
     */
    public function addImage(\Boom\Bundle\LibraryBundle\Entity\Image $images)
    {
        $this->images[] = $images;
        return $this;
    }

    /**
     * Remove images
     *
     * @param <variableType$images
     */
    public function removeImage(\Boom\Bundle\LibraryBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set user
     *
     * @param Boom\Bundle\LibraryBundle\Entity\User $user
     * @return Gallery
     */
    public function setUser(\Boom\Bundle\LibraryBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Boom\Bundle\LibraryBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}