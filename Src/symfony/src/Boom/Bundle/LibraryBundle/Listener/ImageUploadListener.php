<?php

namespace Boom\Bundle\LibraryBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Image;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use phMagick\Core\Runner;
use phMagick\Action\Resize\Proportional;
use \Imagick;

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

    private function markRemove(Image $entity) {
        $this->fileForRemove[spl_object_hash($entity)] = $this->getAbsolutePath($entity);
    }

    private function removeMarked(Image $entity) {
        if ($this->fileForRemove[spl_object_hash($entity)]) {
            unlink($this->fileForRemove[spl_object_hash($entity)]);
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
            if (null !== $entity->getPath()) {
                $this->markRemove($entity);
            }
            if (null !== $entity->getFile()) {
                $entity->setPath(substr(md5(uniqid($entity->getId(), true)), 0, 8) . '.' . $entity->getFile()->guessExtension());
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

            if (file_exists($image->getRealPath())) {
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

    protected function getUploadDir() {
        return $this->container->getParameter('boom_library.boom_image_path');
    }

    protected function getAbsolutePath(Image $entity) {
        return null === $entity->getPath() ? null : $this->getUploadRootDir() . $entity->getPath();
    }

    protected function thumbGenerator(Image $entity) {
        $path = $this->getAbsolutePath($entity);
        $sizes = $this->container->getParameter('boom_library.boom_image_sizes');
        $fileName = $entity->getPath();
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
                $imageClone = $this->resizeOperation($imageClone,$size['width'], $size['height'],$size['thumbnail']);
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
            $imagick = $this->resizeOperation($imagick,$size['width'], $size['height'],$size['thumbnail']);
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

    protected function resizeOperation(\Imagick $imagick,$width,$height,$thumbnail = false){

            if ($thumbnail == true) {
                $imagick->cropThumbnailImage($width, $height);
                $imagick->setImagePage(0, 0, 0, 0);
            } else {
                $background = new \Imagick($this->container->getParameter('boom_library.boom_image_background'));
                $background->cropImage($width, $height,0,0);
                $imagick->adaptiveResizeImage($width, $height, true);
                $imageSize = $imagick->getImageGeometry();
                $x = ($width/2)-($imageSize['width']/2);
                $y = ($height/2)-($imageSize['height']/2);
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