<?php
namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity
 * @ORM\Table(name="list_element")
 */
class ListElement extends DomainObject{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="integer")
     * @Gedmo\SortablePosition
     */
    protected $position;

    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $summary;

    /**
     * @ORM\Column(type="text")
     */
    protected $url;

    /**
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="list_elements", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=false)
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="Boom", inversedBy="list_elements", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="boom_id", referencedColumnName="id", nullable=true)
     */
    protected $boom;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="list_elements", fetch="EAGER")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="ListGroup", inversedBy="list_elements", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="list_group_id", referencedColumnName="id", nullable=false)
     * @Gedmo\SortableGroup
     */
    protected $list_group;


    public function __construct(){
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
     * Set position
     *
     * @param integer $position
     * @return ListElement
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
     * Set title
     *
     * @param string $title
     * @return ListElement
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
     * Set summary
     *
     * @param string $summary
     * @return ListElement
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return ListElement
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set image
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Image $image
     * @return ListElement
     */
    public function setImage(\Boom\Bundle\LibraryBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return Boom\Bundle\LibraryBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set boom
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $boom
     * @return ListElement
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
     * Set category
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Category $category
     * @return ListElement
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
     * Set list_group
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListGroup $listGroup
     * @return ListElement
     */
    public function setListGroup(\Boom\Bundle\LibraryBundle\Entity\ListGroup $listGroup)
    {
        $this->list_group = $listGroup;
        return $this;
    }

    /**
     * Get list_group
     *
     * @return Boom\Bundle\LibraryBundle\Entity\ListGroup
     */
    public function getListGroup()
    {
        return $this->list_group;
    }
}