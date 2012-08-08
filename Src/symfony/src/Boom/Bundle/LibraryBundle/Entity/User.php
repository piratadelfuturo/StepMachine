<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use FOS\UserBundle\Model\GroupInterface;

/**
 * @ORM\Entity(repositoryClass="Boom\Bundle\LibraryBundle\Repository\UserRepository")
 * @ORM\Table(name="bm_user")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "admin" = "Admin"})
 */
class User extends BaseUser implements \ArrayAccess {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255 , nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="facebookId", type="string", length=255, nullable=true, unique=true)
     */
    protected $facebookId;

    /**
     * @var string
     *
     * @ORM\Column(name="twitterId", type="string", length=255, nullable=true, unique=true)
     */
    protected $twitterId;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_username", type="string", length=255, nullable=true)
     */
    protected $twitter_username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nickname;

    /**
     * @ORM\Column(type="string", length=140,nullable=true,unique=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="text", length=140,nullable=true)
     */
    protected $bio;

    /**
     * @ORM\OneToMany(targetEntity="Boom", mappedBy="user")
     * */
    protected $booms;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="user")
     * */
    protected $images;

    /**
     * @ORM\OneToMany(targetEntity="Gallery", mappedBy="user")
     * */
    protected $galleries;

    /**
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="bm_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    public function __construct() {
        parent::__construct();
        $this->booms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galleries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function serialize() {
        return serialize(
                        array(
                            $this->facebookId,
                            $this->twitterId,
                            parent::serialize()
                        )
        );
    }

    public function unserialize($data) {
        list(
                $this->facebookId,
                $this->twitterId,
                $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }

    /**
     * @param Array
     */
    public function setFBData($fbdata) {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
        }

        if ($this->getUsername() == null || $this->getUsername() == '') {
            //$this->setUsername($fbdata['username']);
        }

        if (isset($fbdata['email'])) {
            //$this->setEmail($fbdata['email']);
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId() {
        return $this->facebookId;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname) {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname() {
        return $this->nickname;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set bio
     *
     * @param text $bio
     * @return User
     */
    public function setBio($bio) {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Get bio
     *
     * @return text
     */
    public function getBio() {
        return $this->bio;
    }

    /**
     * Add booms
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $booms
     * @return User
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
     * Add images
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Image $images
     * @return User
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
     * Add galleries
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Gallery $galleries
     * @return User
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
     * Add groups
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(GroupInterface $groups) {
        $this->groups[] = $groups;
        return $this;
    }

    /**
     * Remove groups
     *
     * @param <variableType$groups
     */
    public function removeGroup(GroupInterface $groups) {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getGroups() {
        return $this->groups;
    }

    /**
     * Get the full name of the user (first + last name)
     * @return string
     */
    public function getFullName() {
        return $this->getFirstName() . ' ' . $this->getLastname();
    }

    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId) {
        $this->facebookId = $facebookId;
        $this->salt = '';
    }

    /**
     * Set twitterID
     *
     * @param string $twitterID
     */
    public function setTwitterId($twitterId) {
        $this->twitterId = $twitterId;
        $this->salt = '';
    }

    /**
     * Get twitterID
     *
     * @return string
     */
    public function getTwitterId() {
        return $this->twitterId;
    }

    /**
     * Set twitter_username
     *
     * @param string $twitterUsername
     */
    public function setTwitterUsername($twitterUsername) {
        $this->twitter_username = $twitterUsername;
    }

    /**
     * Get twitter_username
     *
     * @return string
     */
    public function getTwitterUsername() {
        return $this->twitter_username;
    }

    public function setTwitterData(array $info) {

        $username = $info->screen_name;
        $bmUsername = $this->getUsername();

        $user->setTwitterID($info->id);
        $user->setTwitterUsername($username);
        //$user->setEmail('');

        if (is_null($bmUsername) || empty($bmUsername)) {
            $this->setUsername($username);
        }

        //$user->setFirstname($info->name);
    }

    public function offsetExists($offset) {
        // In this example we say that exists means it is not null
        $value = $this->{"get$offset"}();
        return $value !== null;
    }

    public function offsetSet($offset, $value) {
        //$this->{"set$offset"}($value);
        throw new BadMethodCallException("Array access of class " . get_class($this) . " is read-only!");
    }

    public function offsetGet($offset) {
        return $this->{"get$offset"}();
    }

    public function offsetUnset($offset) {
        //$this->{"set$offset"}(null);
        throw new BadMethodCallException("Array access of class " . get_class($this) . " is read-only!");
    }


}