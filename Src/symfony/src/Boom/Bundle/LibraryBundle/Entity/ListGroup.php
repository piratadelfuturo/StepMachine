<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="list_group")
 */
class ListGroup extends DomainObject {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Gedmo\SortableGroup
     * @ORM\Column(type="string", length=140)
     */
    protected $block;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $name;

    /**
     * @Gedmo\Slug(fields={"name"},unique=true,updatable=false)
     * @ORM\Column(type="string", length=140, unique=true)
     */
    protected $slug;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $update_date;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="list_groups")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="ListElement", mappedBy="list_group", cascade={"all"} )
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $list_elements;

    /**
     * Constructor
     */
    public function __construct() {
        $this->list_elements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ListGroup
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set category
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Category $category
     * @return ListGroup
     */
    public function setCategory(\Boom\Bundle\LibraryBundle\Entity\Category $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Boom\Bundle\LibraryBundle\Entity\Category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Add list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listelements
     * @return ListGroup
     */
    public function addListElement(\Boom\Bundle\LibraryBundle\Entity\ListElement $listelements) {
        $listelements->setListGroup($this);
        $this->list_elements[] = $listelements;

        return $this;
    }

    /**
     * Remove list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listelements
     */
    public function removeListElement(\Boom\Bundle\LibraryBundle\Entity\ListElement $listelements) {
        $this->list_elements->removeElement($listelements);
    }

    /**
     * Get list_elements
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getListElements() {
        return $this->list_elements;
    }

    /**
     * Set list_elements
     *
     * @return ListGroup
     */
    public function setListElements(Collection $list_elements = null) {
        if ($list_elements !== null) {
            foreach ($list_elements as $list_element) {
                $list_element->setListGroup($this);
            }
        }
        $this->list_elements = $list_elements;
        return $this;
    }

    public function getUpdateDate() {
        return $this->update_date;
    }

    public function setUpdateDate(\DateTime $update_date) {
        $this->update_date = $update_date;
    }

    public function getBlock() {
        return $this->block;
    }

    public function setBlock($block) {
        $this->block = $block;
    }

    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ListGroup
     */
    public function setSlug($slug) {
        if (empty($this->slug) || is_null($this->slug)) {
            $this->slug = $slug;
        }
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

}