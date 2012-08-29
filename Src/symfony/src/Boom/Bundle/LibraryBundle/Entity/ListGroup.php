<?php
namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity
 * @ORM\Table(name="list_group")
 */
class ListGroup extends DomainObject{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="list_groups")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="ListElement", mappedBy="list_group" )
     */
    protected $list_elements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listelements = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return ListGroup
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
     * Set category
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Category $category
     * @return ListGroup
     */
    public function setCategory(\Boom\Bundle\LibraryBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Boom\Bundle\LibraryBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listelements
     * @return ListGroup
     */
    public function addListElement(\Boom\Bundle\LibraryBundle\Entity\ListElement $listelements)
    {
        $this->list_elements[] = $listelements;

        return $this;
    }

    /**
     * Remove list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listelements
     */
    public function removeListElement(\Boom\Bundle\LibraryBundle\Entity\ListElement $listelements)
    {
        $this->list_elements->removeElement($listelements);
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