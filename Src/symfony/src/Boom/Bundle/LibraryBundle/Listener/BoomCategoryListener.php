<?php
namespace Boom\Bundle\LibraryBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Category;

/**
 * Description of BoomCategoryListener
 *
 * @author daniel
 */
class BoomCategoryListener {


    public function prePersist(LifecycleEventArgs $args){
        $this->syncCategory($args);
    }

    public function preUpdate(LifecycleEventArgs $args){
        $this->syncCategory($args);
    }


    protected function syncCategory(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        if ($entity instanceof Boom) {
            $uow = $em->getUnitOfWork();

            foreach ($uow->getScheduledCollectionUpdates() AS $col) {
            }
        }
    }

}