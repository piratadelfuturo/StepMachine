<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="galleries_images_relations")
 */
class GalleryImageRelation extends DomainObject {

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="galleryimagerelations", cascade={"persist"})
     * @Gedmo\SortableGroup
     */
    private $gallery;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Image")
     */
    private $image;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * Set gallery
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Gallery $gallery
     * @return GalleryImageRelation
     */
    public function setGallery(\Boom\Bundle\LibraryBundle\Entity\Gallery $gallery) {

        $this->gallery = $gallery;
        if(!$gallery->getGalleryimagerelations()->contains($this)){
            $gallery->addGalleryimagerelation($this);
        }

        return $this;
    }

    /**
     * Get gallery
     *
     * @return Boom\Bundle\LibraryBundle\Entity\Gallery
     */
    public function getGallery() {
        return $this->gallery;
    }

    /**
     * Set image
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Image $image
     * @return GalleryImageRelation
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
     * Set position
     *
     * @param integer $position
     * @return GalleryImageRelation
     */
    public function setPosition($position) {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition() {
        return $this->position;
    }

}