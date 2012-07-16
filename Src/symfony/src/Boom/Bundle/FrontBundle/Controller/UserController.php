<?php
namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function userBlockAction($name = 'juanis')
    {        
        
        return $this->render(
                'BoomFrontBundle:User:widget/userBlock.html.php'
                );
    }
}