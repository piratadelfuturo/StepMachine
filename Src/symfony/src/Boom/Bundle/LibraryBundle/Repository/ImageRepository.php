<?php
namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ImageRepository extends EntityRepository {

    /**
     * @param array $get
     * @param bool $flag
     * @return array|\Doctrine\ORM\Query
     */
    public function ajaxTable(array $get, $flag = false) {

        $cb = $this->createQueryBuilder('i')
                ->select(array('i','u.username'));
        $cb->leftJoin('i.user','u');
        $query = $cb->getQuery();

        if($flag = true){
            return $query;
        }else{
            return $query->getResult();
        }
    }


}