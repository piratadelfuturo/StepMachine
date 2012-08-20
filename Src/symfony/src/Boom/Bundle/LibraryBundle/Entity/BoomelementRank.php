<?php
namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="boomelement_rank",
 *  uniqueConstraints={@ORM\UniqueConstraint(name="search_primary", columns={"user_id","boom_id", "boomelement_id"})},
 *  indexes={@ORM\Index(name="primary_index", columns={"user_id","boom_id", "boomelement_id"})}
 * )
 */
class BoomelementRank extends DomainObject{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Boom", inversedBy="booomelementranks")
     * @ORM\JoinColumn(name="boom_id", referencedColumnName="id", nullable=false)
     * @Gedmo\SortableGroup
     */
    protected $boom;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Boomelement", inversedBy="boomelementranks")
     * @ORM\JoinColumn(name="boomelement_id", referencedColumnName="id", nullable=false)
     * @Gedmo\SortableGroup
     */
    protected $boomelement;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", inversedBy="boomelementranks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Gedmo\SortableGroup
     */
    protected $user;

    /**
    * @Gedmo\SortablePosition
    * @ORM\Column(type="integer")
    */
    protected $position;

    public function __construct(){
        parent::__construct();
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return BoomelementRank
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
     * @return BoomelementRank
     */
    public function setBoom(\Boom\Bundle\LibraryBundle\Entity\Boom $boom)
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
     * Set boomelement
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boomelement $element
     * @return BoomelementRank
     */
    public function setBoomelement(\Boom\Bundle\LibraryBundle\Entity\Boomelement $boomelement)
    {
        $this->boomelement = $boomelement;
        return $this;
    }

    /**
     * Get boomelement
     *
     * @return Boom\Bundle\LibraryBundle\Entity\Boomelement
     */
    public function getBoomelement()
    {
        return $this->boomelement;
    }


    /**
     * Set user
     *
     * @param Boom\Bundle\LibraryBundle\Entity\User $user
     * @return BoomelementRank
     */
    public function setUser(\Boom\Bundle\LibraryBundle\Entity\User $user)
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