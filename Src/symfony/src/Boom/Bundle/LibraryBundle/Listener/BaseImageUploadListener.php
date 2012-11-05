<?php

namespace Boom\Bundle\LibraryBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Filesystem\Filesystem;
use \Imagick;

/**
 * Description of BoomCategoryListener
 *
 * @author daniel
 */
abstract class BaseImageUploadListener implements ContainerAwareInterface {

    protected $container;
    protected $fileForRemove;
    protected $backgroundImage;
    protected $sizesList;
    protected $uploadDir;
    protected $webPath;
    protected $entityClassName;
    protected $entityGetFileMethod;
    protected $entityGetPathMethod;
    protected $entitySetPathMethod;
    protected $entityPathProperty;
    protected $entityGetIdMethod;
    protected $entityGetPreviousPathMethod;

    public function __construct(ContainerInterface $container) {
        $this->setContainer($container);
        $this->entityGetFileMethod = 'getFile';
        $this->entityGetPathMethod = 'getPath';
        $this->entitySetPathMethod = 'setPath';
        $this->entityPathProperty = 'path';
        $this->entityGetIdMethod = 'getId';
        $this->entityGetPreviousPathMethod = 'getPreviousPathMethod';
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function postRemove(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if (get_class($entity) == $this->entityClassName) {
            $this->removeMarked($entity);
        }
    }

    public function preRemove(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if (get_class($entity) == $this->entityClassName) {
            $this->markRemove($entity);
        }
    }

    private function markRemove($entity) {
        $previous = $entity->{$this->entityGetPreviousPathMethod}();
        if (!empty($previous) && !is_null($previous)) {
            $this->fileForRemove[(string) spl_object_hash($entity)] = (string) $this->getAbsolutePath($entity->{$this->entityGetPreviousPathMethod}());
        }
    }

    private function unlink($path) {
        try {
            return unlink($path);
        } catch (\Exception $e) {
            return false;
        }
    }

    private function removeMarked($entity) {
        if (isset($this->fileForRemove[(string) spl_object_hash($entity)]) && !is_null($this->fileForRemove[(string) spl_object_hash($entity)])) {
            $this->unlink($this->fileForRemove[(string) spl_object_hash($entity)]);
        }
    }

    public function postPersist(LifecycleEventArgs $args) {
        $this->upload($args);
    }

    public function postUpdate(LifecycleEventArgs $args) {
        $this->upload($args);
    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $this->preUpload($args);
    }

    public function prePersist(LifecycleEventArgs $args) {
        $this->preUpload($args);
    }

    public function preUpload(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if (get_class($entity) == $this->entityClassName) {

            if (null !== $entity->{$this->entityGetPathMethod}()) {
                $this->markRemove($entity);
            }
            if (null !== $entity->{$this->entityGetFileMethod}()) {
                $newValue = substr(md5(uniqid($entity->{$this->entityGetIdMethod}(), true)), 0, 8) .
                        '.' .
                        $entity->{$this->entityGetFileMethod}()->guessExtension();
                if ($args instanceof PreUpdateEventArgs) {
                    $args->setNewValue($this->entityPathProperty, $newValue);
                    $em = $args->getEntityManager();
                    $uow = $em->getUnitOfWork();
                    $uow->recomputeSingleEntityChangeSet($meta, $entity);
                } else {
                    $entity->setPath($newValue);
                }
            }
        }
    }

    public function upload(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if (get_class($entity) == $this->entityClassName) {
            $image = $entity->{$this->entityGetFileMethod}();
            if (null === $image) {
                return false;
            }

            $image->move($this->getUploadRootDir(), $entity->{$this->entityGetPathMethod}());
            $this->thumbGenerator($this->getAbsolutePath($entity->{$this->entityGetPathMethod}()), $entity->{$this->entityGetPathMethod}());
            $this->removeMarked($entity);

            if (file_exists($image->getRealPath()) === true) {
                unlink($image->getRealPath());
            }
            unset($image);
        }
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        $fs = new Filesystem();
        $image_path = $this->webPath . $this->getUploadDir();
        if (!$fs->exists($image_path)) {
            $fs->mkdir($image_path, 0777);
        }

        return $image_path;
    }

    protected function getUploadDir() {
        return $this->uploadDir;
    }

    protected function getAbsolutePath($pathImage) {
        return null === $pathImage ? null : $this->getUploadRootDir() . $pathImage;
    }

    protected function thumbGenerator($absolutePath, $pathImage) {
        $path = $absolutePath;
        $sizes = $this->sizesList;
        $fileName = $pathImage;
        $fileName = explode('.', $fileName);

        $thumbPath = $this->getUploadRootDir() . $fileName[0] . '/';
        $fileExt = $fileName[1];

        $imagick = new \Imagick($path);

        $fs = new Filesystem();
        if (!$fs->exists($thumbPath)) {
            $fs->mkdir($thumbPath, 0777);
        }

        foreach ($sizes as $size) {
            if ($imagick->getImageFormat() == 'GIF') {
                $this->resizeGif($imagick, $fileExt, $thumbPath, $size, $background);
            } else {
                $imageSize = $imagick->getImageGeometry();
                //if( !($imageSize['width'] <= $size['width'] && $imageSize['height'] <= $size['height']) ){
                $imageClone = clone($imagick);
                $imageClone = $this->resizeOperation($imageClone, $size['width'], $size['height'], $size['thumbnail']);
                $imageClone->writeImage(
                        $thumbPath . $size['width'] . '_' . $size['height'] . '.' . $fileExt
                );
                $imageClone->clear();
                $imageClone->destroy();
                //}
            }
        }
        $imagick->clear();
        $imagick->destroy();
    }

    protected function resizeGif(Imagick $imagickObj, $fileExt, $thumbPath, array $size, \Imagick $background = null) {
        $imagick = clone($imagickObj);
        $imagick = $imagick->coalesceImages();
        $imageSize = $imagick->getImageGeometry();
        do {
            //if (!($imageSize['width'] <= $size['width'] && $imageSize['height'] <= $size['height'])) {
            $imagick = $this->resizeOperation($imagick, $size['width'], $size['height'], $size['thumbnail']);
            //}
        } while ($imagick->nextImage());
        $imagick = $imagick->deconstructImages();
        $imagick->writeImages(
                $thumbPath . $size['width'] . '_' . $size['height'] . '.' . $fileExt, true
        );
        $imagick->clear();
        $imagick->destroy();
        return $imagickObj;
    }

    protected function resizeOperation(\Imagick $imagick, $width, $height, $thumbnail = false) {

        if ($thumbnail == true) {
            $imagick->cropThumbnailImage($width, $height);
            $imagick->setImagePage(0, 0, 0, 0);
        } else {
            $background = new \Imagick($this->backgroundImage);
            $background->cropImage($width, $height, 0, 0);
            $imagick->adaptiveResizeImage($width, $height, true);
            $imageSize = $imagick->getImageGeometry();
            $x = ($width / 2) - ($imageSize['width'] / 2);
            $y = ($height / 2) - ($imageSize['height'] / 2);
            //$background->flattenImages();
            $background->compositeImage($imagick, \Imagick::COMPOSITE_OVER, $x, $y);
            $background->flattenImages();
            $imagick->setImage($background);
            $background->clear();
            $background->destroy();
        }
        return $imagick;
    }

}