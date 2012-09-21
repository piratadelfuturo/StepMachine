<?php
namespace Boom\Bundle\LibraryBundle\FileCache;

class DailySeven {

    public function __construct() {
        $FileCache = new PhpFileCache(
        $this->get('kernel')->getCacheDir(),
                '.dailySeven.php');
        $dailySeven = $FileCache->fetch('dailySeven');

        return $this;
    }

}