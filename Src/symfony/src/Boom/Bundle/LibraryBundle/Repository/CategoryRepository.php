<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Boom\Bundle\LibraryBundle\Entity\Category;
use Boom\Bundle\LibraryBundle\Entity\Boom;

class CategoryRepository extends EntityRepository {

    public function findBoomsByCategory(Category $category, $sort = array('date_created' => 'DESC'), $limit = 7, $offset = 0, array $status = array()) {

        $sortKey = \key($sort);
        $sortValue = \current($sort);

        $statusFilter = array();
        $statusOptions = Boom::getStatusEnumFieldValues();

        if(empty($status)){
            $status[] = Boom::STATUS_PUBLIC;
        }
        foreach($status as $stat){
            if(in_array($stat,$statusOptions)){
                $statusFilter[] = $stat;
            }
        }

        $qString = "
            SELECT
                boom
            FROM
                BoomLibraryBundle:Boom boom
            LEFT JOIN
                boom.category category
            WHERE
                boom.category = :category
            AND
                boom.status IN (:status)
            ORDER BY boom.{$sortKey} {$sortValue}";

        $em = $this->getEntityManager();
        $query = $em->createQuery($qString);
        $query->setParameters(array('category' => $category,'status' =>$status));
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);
        $result = $query->execute();

        return $result;
    }

        /**
     * @param array $get
     * @param bool $flag
     * @return array|\Doctrine\ORM\Query
     */
    public function ajaxTable(array $get, $flag = false) {

        /**
         * Set to default
         */
        $return = Utils::processAjaxTable($this,$get,$flag);

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

    public function findFeaturedCategories(){
        $query = $this->createQueryBuilder('a')
                ->select(array('a.slug', 'a.name', 'a.position'))
                ->select(array('a'))
                ->orderBy('a.position','ASC')
                ->where('a.featured = 1')
                ->getQuery();
        //$query->useResultCache(true,600,'boom_category_featured');
        $result = $query->setHydrationMode(Query::HYDRATE_SCALAR)
                ->execute();

        return $result;

    }


}