<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Boom\Bundle\LibraryBundle\Entity\Category;
use Boom\Bundle\LibraryBundle\Entity\Boom;

class CategoryRepository extends EntityRepository {

    /**
     * @param array $get
     * @param bool $flag
     * @return array|\Doctrine\ORM\Query
     */
    public function ajaxTable(array $get, $flag = false) {

        /**
         * Set to default
         */
        $return = Utils::processAjaxTable($this, $get, $flag);

        return $return;
    }

    /**
     * @return int
     */
    public function getCount() {
        $aResultTotal = $this->createQueryBuilder('a')
                ->select('COUNT(a)')
                ->setMaxResults(1)
                ->getQuery()
                ->getResult();
        return (int) $aResultTotal[0][1];
    }

    public function findFeaturedCategories() {
        $qb = $this->createQueryBuilder('a');

        $qb->select(array('a.slug', 'a.name', 'a.position'))
                ->select(array('a'))
                ->orderBy('a.position', 'ASC')
                ->where(
                        $qb->expr()->eq('a.featured', true)
        );
        $query = $qb->getQuery();
        $query->useResultCache(true, 120);
        $result = $qb->setHydrationMode(Query::HYDRATE_SCALAR)
                ->execute();

        return $result;
    }

}