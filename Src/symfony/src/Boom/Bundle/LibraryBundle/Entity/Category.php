<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category") 
 */
class Category {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;
    
    /**
     * @ORM\ManyToMany(targetEntity="Boom", mappedBy="categories")
     * @ORM\JoinTable(name="booms_categories",
     *      inverseJoinColumns={@ORM\JoinColumn(name="boom_id", referencedColumnName="id")},
     *      joinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     *      )
     */
    protected $booms;    

    public function __construct()
    {
        $this->booms = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
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
     * Set position
     *
     * @param integer $position
     * @return Category
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    

    /**
     * Add booms
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $booms
     * @return Category
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
}