<?php

namespace Boom\Bundle\LibraryBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Image;
use Symfony\Component\DependencyInjection\ContainerInterface;
use \Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;


/**
 * Description of BoomCategoryListener
 *
 * @author daniel
 */
class ImageUploadListener implements ContainerAwareInterface {

    protected $container;
    protected $fileForRemove;

    public function __construct(ContainerInterface $container) {
        $this->setContainer($container);
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function postRemove(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        if ($entity instanceof Image) {
            $this->removeMarked($entity);
        }
    }

    public function preRemove(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        if ($entity instanceof Image) {
            $this->markRemove($entity);
        }
    }

    private function markRemove(Image $entity){
        $this->fileForRemove[spl_object_hash($entity)] = $this->getAbsolutePath($entity);
    }

    private function removeMarked(Image $entity){
        if ($this->filenameForRemove[spl_object_hash($entity)]) {
            unlink($this->filenameForRemove[spl_object_hash($entity)]);
        }
    }

    public function postPersist(LifecycleEventArgs $args) {
        $this->upload($args);
    }

    public function postUpdate(LifecycleEventArgs $args) {
        $this->upload($args);
    }

    public function preUpdate(LifecycleEventArgs $args) {
        $this->preUpload($args);
    }

    public function prePersist(LifecycleEventArgs $args) {
        $this->preUpload($args);
    }

    public function preUpload(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        if ($entity instanceof Image) {
            if(null !== $entity->getPath()){
                $this->markRemove($entity);
            }
            if (null !== $entity->getFile()) {
                $entity->setPath(substr(md5(uniqid($entity->getId(), true)), 0, 8).'.'.$entity->getFile()->guessExtension());
            }
        }
    }

    public function upload(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        if ($entity instanceof Image) {
            $image = $entity->getFile();
            if (null === $image) {
                return;
            }

            $image->move($this->getUploadRootDir(), $entity->getPath());
            $this->thumbGenerator($entity);
            $this->removeMarked($entity);

            if(file_exists($image->getRealPath())){
                unlink($image->getRealPath());
            }
            unset($image);
        }
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        $fs = new Filesystem();
        $image_path = $this->container->getParameter('boom_library.web_path') . $this->getUploadDir();
        if (!$fs->exists($image_path)) {
            $fs->mkdir($image_path, 0777);
        }

        return $image_path;
    }

    protected function getUploadDir(){
        return $this->container->getParameter('boom_library.boom_image_path');
    }

    protected function getAbsolutePath(Image $entity) {
        return null === $entity->getPath() ? null : $this->getUploadRootDir() . $entity->getPath();
    }


    protected function thumbGenerator(Image $entity){
        $path = $this->getAbsolutePath($entity);
        $sizes = $this->container->getParameter('boom_library.boom_image_sizes');
        var_dump($sizes);
        exit;

    }

}