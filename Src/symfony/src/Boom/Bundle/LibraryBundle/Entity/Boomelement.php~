<?php
namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="boomelement")
 */
class Boomelement {

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
     * @ORM\Column(type="text")
     */
    protected $content;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\ManyToOne(targetEntity="Boom", inversedBy="elements")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    protected $boom;

    /**
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="image")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    protected $image;

    

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
     * @return Boomelement
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
     * Set content
     *
     * @param text $content
     * @return Boomelement
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Boomelement
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
     * Set boom
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $boom
     * @return Boomelement
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
     * Set image
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Image $image
     * @return Boomelement
     */
    public function setImage(\Boom\Bundle\LibraryBundle\Entity\Image $image = null)
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
}