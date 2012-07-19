<?php

namespace Boom\Bundle\LibraryBundle\Entity;
   
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="user") 
 */
class User {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
       
    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $facebook_id; 
    
    /**
     * @ORM\Column(type="string", length=140)
     */    
    protected $nickname;
    
    /**
     * @ORM\Column(type="string", length=140)
     */    
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=140)
     */    
    protected $email;
    
    /**
     * @ORM\Column(type="text", length=140)
     */    
    protected $bio;
    
    /**
     * @ORM\OneToMany(targetEntity="Boom", mappedBy="user")
     **/
    protected $booms;
    
    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="user")
     **/
    protected $images;
    
    /**
     * @ORM\OneToMany(targetEntity="Gallery", mappedBy="user")
     **/
    protected $galleries;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Level", inversedBy="users")
     * @ORM\JoinTable(name="users_levels")
     **/
    protected $levels;
    
    public function __construct()
    {
        $this->booms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galleries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->levels = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set facebook_id
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;
        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set bio
     *
     * @param text $bio
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Get bio
     *
     * @return text 
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Add booms
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $booms
     * @return User
     */
    public function addBoom(\Boom\Bundle\LibraryBundle\Entity\Boom $booms)
    {
        $this->booms[] = $booms;
        return $this;
    }

    /**
     * Remove booms
     *
     * @param <variableType$booms
     */
    public function removeBoom(\Boom\Bundle\LibraryBundle\Entity\Boom $booms)
    {
        $this->booms->removeElement($booms);
    }

    /**
     * Get booms
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBooms()
    {
        return $this->booms;
    }

    /**
     * Add images
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Image $images
     * @return User
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
     * Add galleries
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Gallery $galleries
     * @return User
     */
    public function addGallerie(\Boom\Bundle\LibraryBundle\Entity\Gallery $galleries)
    {
        $this->galleries[] = $galleries;
        return $this;
    }

    /**
     * Remove galleries
     *
     * @param <variableType$galleries
     */
    public function removeGallerie(\Boom\Bundle\LibraryBundle\Entity\Gallery $galleries)
    {
        $this->galleries->removeElement($galleries);
    }

    /**
     * Get galleries
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGalleries()
    {
        return $this->galleries;
    }



    /**
     * Add levels
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Level $levels
     * @return User
     */
    public function addLevel(\Boom\Bundle\LibraryBundle\Entity\Level $levels)
    {
        $this->levels[] = $levels;
        return $this;
    }

    /**
     * Remove levels
     *
     * @param <variableType$levels
     */
    public function removeLevel(\Boom\Bundle\LibraryBundle\Entity\Level $levels)
    {
        $this->levels->removeElement($levels);
    }

    /**
     * Get levels
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLevels()
    {
        return $this->levels;
    }
}