<?php
namespace Boom\Bundle\FrontBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Boom
{
    
    protected $id;
    
    protected $slug;
    
    protected $title;
    
    protected $summary;
    
    protected $dateCreated;
    
    protected $datePublished;
    
    protected $nsfw;

    protected $image;
    
    protected $user;    

    protected $parent;

    protected $children;
      
    protected $categories;
        
    protected $tags;
        
    protected $elements;
    
    
    public function __construct(User $user, Boom $parent = null, $title){
        
        
        $this->user = $user;
        
        $this->parent = $parent;
        
        $this->title = $title;
        
        $this->categories = new ArrayCollection();
        
        $this->tags = new ArrayCollection();
        
        $this->elements = new ArrayCollection();

        $this->children = new ArrayCollection();

    }
      
}