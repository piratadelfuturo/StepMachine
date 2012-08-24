<?php

namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use FOS\UserBundle\Model\GroupInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;

/**
 * @ORM\Entity(repositoryClass="Boom\Bundle\LibraryBundle\Repository\UserRepository")
 * @ORM\Table(name="bm_user")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser implements \ArrayAccess {


    const IMAGE_PATH = 0;
    const IMAGE_FACEBOOK = 1;
    const IMAGE_TWITTER = 2;

    const ROLE_ADMIN = 'ROLE_ADMIN';

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
     * @ORM\OneToMany(targetEntity="BoomelementRank", mappedBy="user", cascade={"all"}, orphanRemoval=true, fetch="EXTRA_LAZY")
     * */
    protected $boomelementranks;

    /**
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="user", cascade={"all"}, orphanRemoval=true, fetch="EXTRA_LAZY")
     * */
    protected $activities;

    /**
     * @ORM\OneToMany(targetEntity="Boom", mappedBy="user",fetch="EXTRA_LAZY")
     * */
    protected $booms;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="user",fetch="EXTRA_LAZY")
     * */
    protected $images;

    /**
     * @ORM\OneToMany(targetEntity="Gallery", mappedBy="user",fetch="EXTRA_LAZY")
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

    /**
     * @ORM\ManyToMany(targetEntity="Boom", inversedBy="favorite_users", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="bm_user_favorite_boom",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="boom_id", referencedColumnName="id")}
     * )
     */
    protected $favorites;


    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="followers", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="follow",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="follow_user_id", referencedColumnName="id")}
     *      )
     */
    protected $following;


    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="following", fetch="EXTRA_LAZY")
     */
    protected $followers;

    /**
     * @ORM\Column(type="text", length=140,nullable=true)
     */
    protected $image_path;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $image_option;


    protected $profile_image;

    public function __construct() {
        parent::__construct();
        $this->booms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galleries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->following = new \Doctrine\Common\Collections\ArrayCollection();
        $this->followers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->boomelementranks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->favorites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setImageOption(self::IMAGE_PATH);
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

    public function setImagePath( $path ){
        $this->setImageOption(self::IMAGE_PATH);
        $this->image_path = $path;
        return $this;
    }

    public function getImagePath( ){
        return $this->image_path;
    }

    public function setImageOption($option){
        switch($option){
            case($option == self::IMAGE_FACEBOOK):
                if(!empty($this->facebookId)){
                    $this->image_path = "http://graph.facebook.com/{$this->facebookId}/picture?type=large";
                    $this->image_option = $option;
                }
            break;
            case($option == self::IMAGE_TWITTER):
                if(!empty($this->facebookId)){
                    $this->image_path = "https://api.twitter.com/1/users/profile_image?screen_name={$this->twitterId}&size=bigger ";
                    $this->image_option = $option;
                }
            break;
            case(self::IMAGE_PATH):
                $this->image_option = $option;
            break;
        }

        return $this;
    }

    public function getImageOption($option){
        $this->image_option = $option;
    }

    /**
     * Sets the admin status
     *
     * @param Boolean $boolean
     *
     * @return User
     */
    public function setAdmin($boolean)
    {
        if (true === $boolean) {
            $this->addRole(static::ROLE_ADMIN);
        } else {
            $this->removeRole(static::ROLE_ADMIN);
        }

        return $this;
    }


    /**
     * Tells if the the given user has the admin role.
     *
     * @return Boolean
     */
    public function isAdmin()
    {
        return $this->hasRole(static::ROLE_ADMIN);
    }

    /*
    public function getAdmin($admin = false){
        return (bool) $this->isSuperAdmin();
    }*/


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

    public function setFollowers(\Doctrine\Common\Collections\Collection $followers){
        $this->followers = $followers;
        return $this;
    }

    public function getFollowers(){
        return $this->followers;
    }

    public function addFollower(User $follower){
        $this->followers[] = $follower;
        return $this;

    }

    public function removeFollower(User $follower){
        $this->followers->removeElement($follower);
    }

    public function setFollowing(\Doctrine\Common\Collections\Collection $following){
        $this->following = $following;
        return $this;
    }

    public function getFollowing(){
        return $this->following;
    }

    public function addFollowing(User $following){
        $this->following[] = $following;
    }

    public function removeFollowing(User $following){
        $this->following->removeElement($following);
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



    /**
     * Add boomelementranks
     *
     * @param Boom\Bundle\LibraryBundle\Entity\BoomelementRank $boomelementranks
     * @return User
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

    /**
     * Add activities
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Activity $activities
     * @return User
     */
    public function addActivity(\Boom\Bundle\LibraryBundle\Entity\Activity $activities)
    {
        $this->activities[] = $activities;
        return $this;
    }

    /**
     * Remove activities
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Activity $activities
     */
    public function removeActivity(\Boom\Bundle\LibraryBundle\Entity\Activity $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Set activities
     *
     */
    public function setActivities(\Doctrine\Common\Collections\Collection $activities)
    {
        $this->activities = $activities;
        return $this;
    }


    /**
     * Add favorites
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $favorites
     * @return User
     */
    public function addFavorite(\Boom\Bundle\LibraryBundle\Entity\Boom $favorites)
    {
        $this->favorites[] = $favorites;
        return $this;
    }

    /**
     * Remove favorites
     *
     * @param Boom\Bundle\LibraryBundle\Entity\Boom $favorites
     */
    public function removeFavorite(\Boom\Bundle\LibraryBundle\Entity\Boom $favorites)
    {
        $this->favorites->removeElement($favorites);
    }

    /**
     * Get favorites
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getFavorites()
    {
        return $this->favorites;
    }

    public function getProfileImage(){
        return $this->profile_image;
    }

    public function setProfileImage(\Symfony\Component\HttpFoundation\File\File $profile_image){
        $this->profile_image = $profile_image;
        return $this;
    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getProfileImage()) {
            $this->path = $this->getProfileImage()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        $image = $this->getProfileImage();
        if (null === $image) {
            return;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $path = $this->container->getParameter('boom_library.profile_image_path').$this->id.'.'.$image->guessExtension();
        $this->setImagePath($path);
        $image->move($this->getUploadRootDir(), $path);
        $this->setImageOption(self::IMAGE_PATH);
        unlink($image->getRealPath());
        unset($image);
    }


    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        $fs = new Filesystem();
        $image_path = $this->container->getParameter('boom_library.web_path').$this->container->getParameter('boom_library.profile_image_path');
        if(!$fs->exists($image_path)){
            $fs->mkdir($image_path, 0664);
        }

        return $image_path;
    }

}