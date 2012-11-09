<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Boom\Bundle\LibraryBundle\Repository\ImageRepository")
 * @ORM\Table(name="image")
 * @ORM\HasLifecycleCallbacks
 */
class Image extends DomainObject {

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
    protected $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true )
     */
    protected $url;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="images" , fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     * */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Boom", mappedBy="image", fetch="EXTRA_LAZY")
     * */
    protected $booms;

    /**
     * @ORM\OneToMany(targetEntity="Boomelement", mappedBy="image", fetch="EXTRA_LAZY" )
     * */
    protected $boomelements;

    /**
     * @ORM\OneToMany(targetEntity="ListElement", mappedBy="image", fetch="EXTRA_LAZY" )
     */
    protected $list_elements;

    /**
     * Inverse Side
     *
     * @ORM\ManyToMany(targetEntity="Gallery", mappedBy="images", fetch="EXTRA_LAZY")
     */
    protected $galleries;

    /*
     * @ORM\OneToMany(targetEntity="GalleryImageRelation", mappedBy="image", cascade={"remove"}, orphanRemoval=true, fetch="EXTRA_LAZY")
     */
    protected $galleryimagerelations;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $date_created;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $nsfw;

    protected $file;

    protected $previous_path;

    public function __construct() {
        $this->booms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->boomelements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->list_elements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galleries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galleryimagerelations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date_created = new \DateTime();
        $this->nsfw = false;
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
     * Set title
     *
     * @param string $title
     * @return Image
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
     * Set description
     *
     * @param text $description
     * @return Image
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Image
     */
    public function setPath($path) {
        if($path == null){
            $this->setPreviousPath($this->path);
        }
        $this->path = $path;
        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath() {
        if ($this->getId() !== null || $this->path !== null) {
            //return sha1($this->getId()) . '.' . $this->path;
        }
        return $this->path;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Image
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set nsfw
     *
     * @param string $url
     * @return Image
     */
    public function setNsfw($nsfw) {
        $this->nsfw = (bool) $nsfw;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function isNsfw() {
        return (bool) $this->nsfw;
    }

    /**
     * Set file
     *
     * @param string $url
     * @return Image
     */
    public function setFile(\Symfony\Component\HttpFoundation\File\File $file) {
        $this->file = $file;
        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Set user
     *
     * @param Boom\Bundle\LibraryBundle\Entity\User $user
     * @return Image
     */
    public function setUser(\Boom\Bundle\LibraryBundle\Entity\User $user = null) {
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
     * Add booms
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $booms
     * @return Image
     */
    public function addBoom(\Boom\Bundle\LibraryBundle\Entity\Boom $booms) {
        $this->booms[] = $booms;
        return $this;
    }

    /**
     * Remove booms
     *
     * @param <variableType$booms
     */
    public function removeBoom(\Boom\Bundle\LibraryBundle\Entity\Boom $booms) {
        $this->booms->removeElement($booms);
    }

    /**
     * Get booms
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getBooms() {
        return $this->booms;
    }

    /**
     * Add boomelements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boomelement $boomelements
     * @return Image
     */
    public function addBoomelement(\Boom\Bundle\LibraryBundle\Entity\Boomelement $boomelements) {
        $this->boomelements[] = $boomelements;
        return $this;
    }

    /**
     * Remove boomelements
     *
     * @param <variableType$boomelements
     */
    public function removeBoomelement(\Boom\Bundle\LibraryBundle\Entity\Boomelement $boomelements) {
        $this->boomelements->removeElement($boomelements);
    }

    /**
     * Get boomelements
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getBoomelements() {
        return $this->boomelements;
    }

    /**
     * Add galleries
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Gallery $galleries
     * @return Image
     */
    public function addGallerie(\Boom\Bundle\LibraryBundle\Entity\Gallery $galleries) {
        $this->galleries[] = $galleries;
        return $this;
    }

    /**
     * Remove galleries
     *
     * @param <variableType$galleries
     */
    public function removeGallerie(\Boom\Bundle\LibraryBundle\Entity\Gallery $galleries) {
        $this->galleries->removeElement($galleries);
    }

    /**
     * Get galleries
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getGalleries() {
        return $this->galleries;
    }

    /**
     * Set date_created
     *
     * @param datetime $dateCreated
     * @return Image
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
     * Add list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listElements
     * @return Image
     */
    public function addListElements(\Boom\Bundle\LibraryBundle\Entity\ListElement $listElements) {
        $this->list_elements[] = $listElements;
        return $this;
    }

    /**
     * Remove list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listElements
     */
    public function removeListElements(\Boom\Bundle\LibraryBundle\Entity\ListElement $listElements) {
        $this->list_elements->removeElement($listElements);
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
     * Get nsfw
     *
     * @return boolean
     */
    public function getNsfw() {
        return $this->nsfw;
    }

    /**
     * Add list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listElements
     * @return Image
     */
    public function addListElement(\Boom\Bundle\LibraryBundle\Entity\ListElement $listElements) {
        $this->list_elements[] = $listElements;

        return $this;
    }

    /**
     * Remove list_elements
     *
     * @param Boom\Bundle\LibraryBundle\Entity\ListElement $listElements
     */
    public function removeListElement(\Boom\Bundle\LibraryBundle\Entity\ListElement $listElements) {
        $this->list_elements->removeElement($listElements);
    }

    /**
     * Add galleryimagerelations
     *
     * @param Boom\Bundle\LibraryBundle\Entity\GalleryImageRelation $galleryimagerelations
     * @return Image
     */
    public function addGalleryimagerelation(\Boom\Bundle\LibraryBundle\Entity\GalleryImageRelation $galleryimagerelations) {
        $galleryimagerelations->setImage($this);
        $this->boomsgalleryimagerelations[] = $galleryimagerelations;

        return $this;
    }

    /**
     * Remove galleryimagerelations
     *
     * @param Boom\Bundle\LibraryBundle\Entity\GalleryImageRelation $galleryimagerelations
     */
    public function removeGalleryimagerelation(\Boom\Bundle\LibraryBundle\Entity\GalleryImageRelation $galleryimagerelations) {
        $this->galleryimagerelations->removeElement($galleryimagerelations);
    }

    /**
     * Get galleryimagerelations
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getGalleryimagerelations() {
        return $this->galleryimagerelations;
    }

    public function getPreviousPath() {
        return $this->previous_path;
    }

    public function setPreviousPath($previous_path) {
        $this->previous_path = $previous_path;
    }





}