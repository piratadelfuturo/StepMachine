<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="Boom\Bundle\LibraryBundle\Repository\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category extends DomainObject{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=140)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $name;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer")
     */
    protected $position;

    /*
     * @ORM\Column(type="boolean")
     */
    protected $featured;

    /**
     * @ORM\ManyToMany(targetEntity="Boom", mappedBy="categories")
     */
    protected $booms;

    /**
     * @ORM\OneToMany(targetEntity="Boom", mappedBy="main_category" )
     */
    protected $main_booms;

    public function __construct()
    {
        $this->booms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->featured = false;
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
        if(empty($this->slug) || is_null($this->slug)){
            $this->slug = $slug;
        }
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
     * Set featured
     *
     * @param integer $featured
     * @return Category
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
        return $this;
    }

    /**
     * Get featured
     *
     * @return integer
     */
    public function getFeatured()
    {
        return $this->featured;
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