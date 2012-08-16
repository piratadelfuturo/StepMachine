<?php

namespace Boom\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BoomUserBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
