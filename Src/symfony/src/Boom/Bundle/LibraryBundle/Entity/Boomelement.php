<?php
namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="boomelement")
 */
class Boomelement extends DomainObject{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=140, nullable=true)
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\Column(type="integer")
     */
    protected $community_position;

    /**
     * @ORM\ManyToOne(targetEntity="Boom", inversedBy="elements")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=false)
     * @Gedmo\SortableGroup
     **/
    protected $boom;

    /**
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="boomelements")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     **/
    protected $image;

    /**
     * @ORM\OneToMany(targetEntity="BoomelementRank", mappedBy="boomelement", cascade={"all"}, orphanRemoval=true)
     **/
    protected $boomelementranks;


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
        //var_dump($boom);
        if($boom !== $this->boom){
            $boom->addElement($this);
        }

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


    public function __construct()
    {
        $this->community_position = 0;
        $this->boomelementranks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->content = '';

    }

    /**
     * Set community_position
     *
     * @param integer $communityPosition
     * @return Boomelement
     */
    public function setCommunityPosition($communityPosition)
    {
        $this->community_position = (int) $communityPosition;
        return $this;
    }

    /**
     * Get community_position
     *
     * @return integer
     */
    public function getCommunityPosition()
    {
        return $this->community_position;
    }

    /**
     * Add boomelementranks
     *
     * @param Boom\Bundle\LibraryBundle\Entity\BoomelementRank $boomelementranks
     * @return Boomelement
     */
    public function addBoomelementrank(\Boom\Bundle\LibraryBundle\Entity\BoomelementRank $boomelementranks)
    {
        $this->boomelementranks[] = $boomelementranks;
        return $this;
    }

    /**
     * Remove boomelementranks
     *
     * @param Boom\Bundle\LibraryBundle\Entity\BoomelementRank $boomelementranks
     */
    public function removeBoomelementrank(\Boom\Bundle\LibraryBundle\Entity\BoomelementRank $boomelementranks)
    {
        $this->boomelementranks->removeElement($boomelementranks);
    }

    /**
     * Get boomelementranks
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getBoomelementranks()
    {
        return $this->boomelementranks;
    }
}