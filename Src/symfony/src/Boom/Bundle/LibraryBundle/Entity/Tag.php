<?php
namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="Boom\Bundle\LibraryBundle\Repository\TagRepository")
 * @ORM\Table(name="tag")
 * @ORM\HasLifecycleCallbacks
 */
class Tag extends DomainObject{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Gedmo\Slug(fields={"name"},unique=true, updatable=true)
     * @ORM\Column(type="string", length=140, unique=true)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=140, unique=true)
     */
    protected $name;


    /**
     * @ORM\ManyToMany(targetEntity="Boom", mappedBy="tags", fetch="EXTRA_LAZY")
     **/
    protected $booms;

    public function __construct($name)
    {
        $this->setName($name);
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
     * @return Tag
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
     * @return Tag
     */
    public function setName($name)
    {
        $name = trim($name);
        $name = preg_replace('!\s+!', ' ', $name);
        $name = mb_strtolower($name, 'UTF-8');
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
     * Add booms
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $booms
     * @return Tag
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