<?php

namespace Boom\Bundle\LibraryBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of BoomCategoryListener
 *
 * @author daniel
 */
class ImageUploadListener extends BaseImageUploadListener {

    public function __construct(ContainerInterface $container) {
        parent::__construct($container);
        $this->backgroundImage = $this->container->getParameter('boom_library.boom_image_background');
        $this->sizesList    = $this->container->getParameter('boom_library.boom_image_sizes');
        $this->uploadDir    = $this->container->getParameter('boom_library.boom_image_path');
        $this->webPath      = $this->container->getParameter('boom_library.web_path');
        $this->entityClassName = 'Boom\Bundle\LibraryBundle\Entity\Image';
    }
}