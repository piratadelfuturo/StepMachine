<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=140)
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $url;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Boom", mappedBy="image")
     * */
    protected $booms;

    /**
     * @ORM\OneToMany(targetEntity="Boomelement", mappedBy="image")
     * */
    protected $boomelements;

    /**
     * Inverse Side
     *
     * @ORM\ManyToMany(targetEntity="Gallery", mappedBy="images")
     */
    protected $galleries;


    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_created;


    protected $file;

    public function __construct() {
        $this->booms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->boomelements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galleries = new \Doctrine\Common\Collections\ArrayCollection();
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
        $this->path = $path;
        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath() {
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

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath() {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $this->path = uniqid().'.'.$this->file->guessExtension();
        }
    }


    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        // the file property can be empty if the field is not required
        if (null === $this->file) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the target filename to move to
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // set the path property to the filename where you'ved saved the file
        $this->path = $this->file->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }


    /**
     * Set date_created
     *
     * @param datetime $dateCreated
     * @return Image
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
}