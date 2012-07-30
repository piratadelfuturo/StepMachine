<?php
namespace Boom\Bundle\LibraryBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Boom\Bundle\LibraryBundle\Repository\BoomRepository")
 * @ORM\Table(name="boom")
 */
class Boom extends DomainObject
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=140, unique=true)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $summary;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @ORM\Version
     */
    protected $date_published;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $nsfw;

    /**
     * @ORM\ManyToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     **/
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="User", fetch="LAZY")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     **/
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Boom", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     **/
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Boom", mappedBy="parent")
     **/
    protected $children;


    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="categories")
     * @ORM\JoinTable(name="booms_categories",
     *      joinColumns={@ORM\JoinColumn(name="boom_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     *      )
     */
    protected $categories;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="booms")
     * @ORM\JoinTable(name="booms_tags")
     **/
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Boomelement", mappedBy="boom", cascade={"remove"})
     **/
    protected $elements;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->elements = new ArrayCollection();
        $this->nsfw = false;
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
     * @return Boom
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
     * Set title
     *
     * @param string $title
     * @return Boom
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
     * @param text $summary
     * @return Boom
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get summary
     *
     * @return text
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set date_created
     *
     * @param datetime $dateCreated
     * @return Boom
     */
    public function setDateCreated($dateCreated)
    {
        $this->date_created = $dateCreated;
        return $this;
    }

    /**
     * Get date_created
     *
     * @return datetime
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Set date_published
     *
     * @param datetime $datePublished
     * @return Boom
     */
    public function setDatePublished($datePublished)
    {
        $this->date_published = $datePublished;
        return $this;
    }

    /**
     * Get date_published
     *
     * @return datetime
     */
    public function getDatePublished()
    {
        return $this->date_published;
    }

    /**
     * Set nsfw
     *
     * @param boolean $nsfw
     * @return Boom
     */
    public function setNsfw($nsfw)
    {
        $this->nsfw = $nsfw;
        return $this;
    }

    /**
     * Get nsfw
     *
     * @return boolean
     */
    public function getNsfw()
    {
        return $this->nsfw;
    }

    /**
     * Set image
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Image $image
     * @return Boom
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

    /**
     * Set user
     *
     * @param Boom\Bundle\LibraryBundle\Entity\User $user
     * @return Boom
     */
    public function setUser(\Boom\Bundle\LibraryBundle\Entity\User $user = null)
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

    /**
     * Set parent
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $parent
     * @return Boom
     */
    public function setParent(Boom $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Boom\Bundle\LibraryBundle\Entity\Boom
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $children
     * @return Boom
     */
    public function addChildren(\Boom\Bundle\LibraryBundle\Entity\Boom $children)
    {
        $this->children[] = $children;
        return $this;
    }

    /**
     * Remove children
     *
     * @param <variableType$children
     */
    public function removeChildren(\Boom\Bundle\LibraryBundle\Entity\Boom $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add categories
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Category $categories
     * @return Boom
     */
    public function addCategorie(\Boom\Bundle\LibraryBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
        return $this;
    }

    /**
     * Remove categories
     *
     * @param <variableType$categories
     */
    public function removeCategorie(\Boom\Bundle\LibraryBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boomelement $elements
     * @return Boom
     */
    public function addElement(\Boom\Bundle\LibraryBundle\Entity\Boomelement $elements)
    {
        $this->elements[] = $elements;
        return $this;
    }

    /**
     * Remove elements
     *
     * @param <variableType$elements
     */
    public function removeElement(\Boom\Bundle\LibraryBundle\Entity\Boomelement $elements)
    {
        $this->elements->removeElement($elements);
    }

    /**
     * Get elements
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getElements()
    {
        return $this->elements;
    }



    /**
     * Add tags
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Tag $tags
     * @return Boom
     */
    public function addTag(\Boom\Bundle\LibraryBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
        return $this;
    }

    /**
     * Remove tags
     *
     * @param <variableType$tags
     */
    public function removeTag(\Boom\Bundle\LibraryBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        /*$metadata->addPropertyConstraint(
          'nsfw', new Choice(array(
            'choices' => array('male', 'female'),
            'message' => 'Choose a valid gender.',
        )));*/
    }

}