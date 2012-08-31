<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\ExecutionContext;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="Boom\Bundle\LibraryBundle\Repository\BoomRepository")
 * @ORM\Table(name="boom")
 * @ORM\HasLifecycleCallbacks
 */
class Boom extends DomainObject {

    const STATUS_DRAFT      = 0;
    const STATUS_REVIEW     = 1;
    const STATUS_PUBLIC     = 2;
    const STATUS_PRIVATE    = 3;
    const STATUS_DELETE     = 4;
    const STATUS_BLOCK      = 5;

    static private $_StatusEnumFieldValues = null;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Gedmo\Slug(fields={"title"})
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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $date_created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $date_published;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $nsfw;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $reply_enabled;

    /**
     * @ORM\Column(type="integer")
     */
    protected $status;

    /**
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="booms")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     * */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="booms", fetch="LAZY")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true )
     * */
    protected $user;


    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="booms")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    protected $category;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="booms")
     * @ORM\JoinTable(name="booms_tags")
     * */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Boomelement", mappedBy="boom", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     * */
    protected $elements;

    /**
     * @ORM\OneToMany(targetEntity="BoomelementRank", mappedBy="boom", cascade={"all"}, orphanRemoval=true)
     * */
    protected $booomelementranks;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="favorites")
     */
    protected $favorite_users;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $featured;

    /**
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="boom", cascade={"all"}, orphanRemoval=true)
     * */
    protected $activities;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Boom", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Boom", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity="ListElement", mappedBy="boom", fetch="EXTRA_LAZY" )
     */
    protected $list_elements;


    protected $element_amount;

    public function __construct() {

        $this->element_amount = 7;
        $this->children = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->elements = new ArrayCollection();
        $this->list_elements = new ArrayCollection();
        $this->nsfw = false;
        $this->reply_enabled = true;
        $this->status = self::STATUS_DRAFT;
        $this->featured = false;
        $this->summary = '';
        $this->date_published = new \DateTime("now");

        for ($i = 1; $i <= $this->element_amount; $i++) {
            $element = new Boomelement($this);
            $element->setPosition($i);
            $this->elements[] = $element;
        }

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
     * Set slug
     *
     * @param string $slug
     * @return Boom
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

    /**
     * Set title
     *
     * @param string $title
     * @return Boom
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set summary
     *
     * @param text $summary
     * @return Boom
     */
    public function setSummary($summary) {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get summary
     *
     * @return text
     */
    public function getSummary() {
        return $this->summary;
    }

    /**
     * Set date_created
     *
     * @param datetime $dateCreated
     * @return Boom
     */
    public function setDateCreated($dateCreated) {
        $this->date_created = $dateCreated;
        return $this;
    }

    /**
     * Get date_created
     *
     * @return datetime
     */
    public function getDateCreated() {
        return $this->date_created;
    }

    /**
     * Set date_published
     *
     * @param datetime $datePublished
     * @return Boom
     */
    public function setDatePublished($datePublished) {
        $this->date_published = $datePublished;
        return $this;
    }

    /**
     * Get date_published
     *
     * @return datetime
     */
    public function getDatePublished() {
        return $this->date_published;
    }

    /**
     * Set nsfw
     *
     * @param boolean $nsfw
     * @return Boom
     */
    public function setNsfw($nsfw) {
        $this->nsfw = $nsfw;
        return $this;
    }

    /**
     * Get nsfw
     *
     * @return boolean
     */
    public function getNsfw() {
        return $this->nsfw;
    }

    /**
     * Set image
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Image $image
     * @return Boom
     */
    public function setImage(\Boom\Bundle\LibraryBundle\Entity\Image $image) {
        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return Boom\Bundle\LibraryBundle\Entity\Image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set user
     *
     * @param Boom\Bundle\LibraryBundle\Entity\User $user
     * @return Boom
     */
    public function setUser(\Boom\Bundle\LibraryBundle\Entity\User $user) {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Boom\Bundle\LibraryBundle\Entity\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set parent
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $parent
     * @return Boom
     */
    public function setParent(Boom $parent = null) {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Boom\Bundle\LibraryBundle\Entity\Boom
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $children
     * @return Boom
     */
    public function addChild(\Boom\Bundle\LibraryBundle\Entity\Boom $child) {
        $this->children[] = $child;
        return $this;
    }

    /**
     * Remove children
     *
     * @param <variableType$children
     */
    public function removeChild(\Boom\Bundle\LibraryBundle\Entity\Boom $child) {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * Set children
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function setChildren(\Doctrine\Common\Collections\Collection $children) {
        $this->children = $children;
        return $this;
    }

    /**
     * Add elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boomelement $elements
     * @return Boom
     */
    public function addElement(\Boom\Bundle\LibraryBundle\Entity\Boomelement $elements) {

        $this->elements[] = $elements;
        if ($elements->getBoom() == null || $elements->getBoom() !== $this) {
            $elements->setBoom($this);
        }
        return $this;
    }

    /**
     * Remove elements
     *
     * @param <variableType$elements
     */
    public function removeElement(\Boom\Bundle\LibraryBundle\Entity\Boomelement $elements) {
        $this->elements->removeElement($elements);
        $elements->setBoom();
    }

    /**
     * Get elements
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getElements() {
        return $this->elements;
    }

    /**
     * Set elements
     *
     * @return Boom
     */
    public function setElements(\Doctrine\Common\Collections\Collection $elements) {
        $this->elements = $elements;
        return $this;
    }

    /**
     * Add tags
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Tag $tags
     * @return Boom
     */
    public function addTag(\Boom\Bundle\LibraryBundle\Entity\Tag $tags) {
        $this->tags[] = $tags;
        return $this;
    }

    /**
     * Remove tags
     *
     * @param <variableType$tags
     */
    public function removeTag(\Boom\Bundle\LibraryBundle\Entity\Tag $tags) {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Set tags
     *
     * @return Boom
     */
    public function setTags(\Doctrine\Common\Collections\Collection $tags) {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->setDateCreated(new \DateTime());
        $this->setDatePublished(new \DateTime());
    }

    /**
     * @ORM\PrePersist()
     */
    public function preUpdate() {
        $this->setDatePublished(new \DateTime());
    }

    public function validations(ExecutionContext $context) {
        if ($this->getElements()->count() !== 7) {
            $context->addViolationAtSubPath('elements', 'Invalid quantity of elements');
        }
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Boom
     */
    public function setLft($lft) {
        $this->lft = $lft;
        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft() {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Boom
     */
    public function setLvl($lvl) {
        $this->lvl = $lvl;
        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl() {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Boom
     */
    public function setRgt($rgt) {
        $this->rgt = $rgt;
        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt() {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Boom
     */
    public function setRoot($root) {
        $this->root = $root;
        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot() {
        return $this->root;
    }

    public function getBooomelementranks() {
        return $this->booomelementranks;
    }

    public function setBooomelementranks(\Doctrine\Common\Collections\Collection $booomelementranks) {
        $this->booomelementranks = $booomelementranks;
        return $this;
    }

    public function addBoomelementRank(\Boom\Bundle\LibraryBundle\Entity\BoomelementRank $booomelementrank) {
        $this->booomelementranks[] = $booomelementrank;
        return $this;
    }

    public function removeBoomelementRank(\Boom\Bundle\LibraryBundle\Entity\BoomelementRank $booomelementrank) {
        $this->booomelementranks->removeElement($booomelementrank);
    }

    /**
     * Set reply_enabled
     *
     * @param boolean $replyEnabled
     * @return Boom
     */
    public function setReplyEnabled($replyEnabled) {
        $this->reply_enabled = (bool) $replyEnabled;
        return $this;
    }

    /**
     * Get reply_enabled
     *
     * @return boolean
     */
    public function getReplyEnabled() {
        return $this->reply_enabled;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Boom
     */
    public function setStatus($status) {
        if (!in_array($status, self::getStatusEnumFieldValues())) {
            throw new \InvalidArgumentException(
                    sprintf('Invalid value for boom.status : %s.', $status)
            );
        }
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Add booomelementranks
     *
     * @param Boom\Bundle\LibraryBundle\Entity\BoomelementRank $booomelementranks
     * @return Boom
     */
    public function addBooomelementrank(\Boom\Bundle\LibraryBundle\Entity\BoomelementRank $booomelementranks) {
        $this->booomelementranks[] = $booomelementranks;
        return $this;
    }

    /**
     * Remove booomelementranks
     *
     * @param Boom\Bundle\LibraryBundle\Entity\BoomelementRank $booomelementranks
     */
    public function removeBooomelementrank(\Boom\Bundle\LibraryBundle\Entity\BoomelementRank $booomelementranks) {
        $this->booomelementranks->removeElement($booomelementranks);
    }

    /**
     * Add children
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $children
     * @return Boom
     */
    public function addChildren(\Boom\Bundle\LibraryBundle\Entity\Boom $children) {
        $this->children[] = $children;
        return $this;
    }

    /**
     * Remove children
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $children
     */
    public function removeChildren(\Boom\Bundle\LibraryBundle\Entity\Boom $children) {
        $this->children->removeElement($children);
    }

    static public function getStatusEnumFieldValues() {
        if (is_null(self::$_StatusEnumFieldValues)) {
            self::$_StatusEnumFieldValues = array();
            $oClass = new \ReflectionClass(__CLASS__);
            $classConstants = $oClass->getConstants();
            foreach ($classConstants as $key => $val) {
                self::$_StatusEnumFieldValues[$val] = $val;
            }
        }
        return self::$_StatusEnumFieldValues;
    }

    /**
     * Set category
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Category $category
     * @return Boom
     */
    public function setCategory(\Boom\Bundle\LibraryBundle\Entity\Category $category) {
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
     * Set featured
     *
     * @param boolean $featured
     * @return Boom
     */
    public function setFeatured($featured) {
        $this->featured = $featured;
        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean
     */
    public function getFeatured() {
        return $this->featured;
    }

    /**
     * Add favorite_users
     *
     * @param Boom\Bundle\LibraryBundle\Entity\User $favoriteUsers
     * @return Boom
     */
    public function addFavoriteUser(\Boom\Bundle\LibraryBundle\Entity\User $favoriteUsers) {
        $this->favorite_users[] = $favoriteUsers;
        return $this;
    }

    /**
     * Remove favorite_users
     *
     * @param Boom\Bundle\LibraryBundle\Entity\User $favoriteUsers
     */
    public function removeFavoriteUser(\Boom\Bundle\LibraryBundle\Entity\User $favoriteUsers) {
        $this->favorite_users->removeElement($favoriteUsers);
    }

    /**
     * Get favorite_users
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getFavoriteUsers() {
        return $this->favorite_users;
    }

    /**
     * Set favorite_users
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function setFavoriteUsers(\Doctrine\Common\Collections\Collection $favorite_users) {
        array_map(array($this, 'addFavoriteUsers'), $favorite_users);
        //$this->favorite_users = $favorite_users;
        return $this;
    }

    /**
     * Add activities
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Activity $activities
     * @return Boom
     */
    public function addActivity(\Boom\Bundle\LibraryBundle\Entity\Activity $activities) {
        $this->activities[] = $activities;
        return $this;
    }

    /**
     * Remove activities
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Activity $activities
     */
    public function removeActivity(\Boom\Bundle\LibraryBundle\Entity\Activity $activities) {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getActivities() {
        return $this->activities;
    }

    /**
     * Set activities
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function setActivities(\Doctrine\Common\Collections\Collection $activities) {
        array_map(array($this, 'addActivities'), $activities);
        //$this->activities = $activities;
        return $this;
    }

    /**
     * Add list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listElements
     * @return Boom
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