<?php

namespace Boom\Bundle\LibraryBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of BoomCategoryListener
 *
 * @author daniel
 */
class UserImageUploadListener extends BaseImageUploadListener {

    public function __construct(ContainerInterface $container) {
        parent::__construct($container);
        $this->webPath      = $this->container->getParameter('boom_library.web_path');
        $this->backgroundImage = $this->container->getParameter('boom_library.profile_image_background');
        $this->sizesList    = $this->container->getParameter('boom_library.profile_image_sizes');
        $this->uploadDir    = $this->container->getParameter('boom_library.profile_image_path');
        $this->entityClassName = 'Boom\Bundle\LibraryBundle\Entity\User';
        $this->entityGetPathMethod = 'getImagePath';
        $this->entityGetFileMethod = 'getProfileImage';
    }
}