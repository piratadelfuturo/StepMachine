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

    /**
     * @ORM\Column(type="boolean")
     */
    protected $featured;

    /**
     * @ORM\ManyToMany(targetEntity="Boom", mappedBy="categories", fetch="EXTRA_LAZY")
     */
    protected $booms;

    /**
     * @ORM\OneToMany(targetEntity="Boom", mappedBy="main_category", fetch="EXTRA_LAZY" )
     */
    protected $main_booms;

    /**
     * @ORM\OneToMany(targetEntity="ListGroup", mappedBy="category", fetch="EXTRA_LAZY" )
     */
    protected $list_groups;

    /**
     * @ORM\OneToMany(targetEntity="ListElement", mappedBy="category", fetch="EXTRA_LAZY" )
     */
    protected $list_elements;

    public function __construct()
    {
        $this->booms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->list_groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->list_elements = new \Doctrine\Common\Collections\ArrayCollection();
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
        $this->featured = (bool) $featured;
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

    /**
     * Add main_booms
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $mainBooms
     * @return Category
     */
    public function addMainBoom(\Boom\Bundle\LibraryBundle\Entity\Boom $mainBooms)
    {
        $this->main_booms[] = $mainBooms;
        return $this;
    }

    /**
     * Remove main_booms
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $mainBooms
     */
    public function removeMainBoom(\Boom\Bundle\LibraryBundle\Entity\Boom $mainBooms)
    {
        $this->main_booms->removeElement($mainBooms);
    }

    /**
     * Get main_booms
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getMainBooms()
    {
        return $this->main_booms;
    }
    /**
     * Add list_groups
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListGroup $listGroups
     * @return Category
     */
    public function addListGroup(\Boom\Bundle\LibraryBundle\Entity\ListGroup $listGroups)
    {
        $this->list_groups[] = $listGroups;
        return $this;
    }

    /**
     * Remove list_groups
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListGroup $listGroups
     */
    public function removeListGroup(\Boom\Bundle\LibraryBundle\Entity\ListGroup $listGroups)
    {
        $this->list_groups->removeElement($listGroups);
    }

    /**
     * Get list_groups
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getListGroups()
    {
        return $this->list_groups;
    }

    /**
     * Add list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listElements
     * @return Category
     */
    public function addListElements(\Boom\Bundle\LibraryBundle\Entity\ListElement $listElements)
    {
        $this->list_elements[] = $listElements;
        return $this;
    }

    /**
     * Remove list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listElements
     */
    public function removeListElements(\Boom\Bundle\LibraryBundle\Entity\ListElement $listElements)
    {
        $this->list_elements->removeElement($listElements);
    }

    /**
     * Get list_elements
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getListElements()
    {
        return $this->list_elements;
    }

}