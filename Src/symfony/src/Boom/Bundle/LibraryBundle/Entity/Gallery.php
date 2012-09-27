<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gallery")
 */
class Gallery extends DomainObject {

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
     * @ORM\Column(type="text",nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $nsfw;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Image", inversedBy="galleries")
     * @ORM\JoinTable(name="galleries_images",
     *      joinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="gallery_id", referencedColumnName="id")}
     *      )
     */
    protected $images;

    /**
     * @ORM\OneToMany(targetEntity="GalleryImageRelation", mappedBy="gallery", cascade={"all"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $galleryimagerelations;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="galleries")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * */
    protected $user;

    public function __construct() {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galleryimagerelations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Gallery
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
     * Add images
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Image $images
     * @return Gallery
     */
    public function addImage(\Boom\Bundle\LibraryBundle\Entity\Image $images) {
        $this->images[] = $images;
        return $this;
    }

    /**
     * Remove images
     *
     * @param <variableType$images
     */
    public function removeImage(\Boom\Bundle\LibraryBundle\Entity\Image $images) {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * Set user
     *
     * @param Boom\Bundle\LibraryBundle\Entity\User $user
     * @return Gallery
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
     * Set description
     *
     * @param string $description
     * @return Gallery
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set nsfw
     *
     * @param boolean $nsfw
     * @return Gallery
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
     * Add galleryimagerelations
     *
     * @param Boom\Bundle\LibraryBundle\Entity\GalleryImageRelation $galleryimagerelations
     * @return Gallery
     */
    public function setGalleryimagerelations(array $galleryimagerelations = array()) {
        $this->galleryimagerelations->clear();
        foreach ($galleryimagerelations as $relation) {
                $this->addGalleryimagerelation($relation);
        }
        return $this;
    }

    /**
     * Add galleryimagerelations
     *
     * @param Boom\Bundle\LibraryBundle\Entity\GalleryImageRelation $galleryimagerelations
     * @return Gallery
     */
    public function addGalleryimagerelation(\Boom\Bundle\LibraryBundle\Entity\GalleryImageRelation $galleryimagerelations) {
        $this->galleryimagerelations[] = $galleryimagerelations;
        if($galleryimagerelations['gallery'] !== $this){
            $galleryimagerelations->setGallery($this);
        }

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

}