<?php
namespace Boom\Bundle\LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity
 * @ORM\Table(name="news_subscriber")
 * @ORM\HasLifecycleCallbacks
 */
class NewsletterSubscriber extends DomainObject{

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=140, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=140, unique=true)
     */
    protected $name;


    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }


}