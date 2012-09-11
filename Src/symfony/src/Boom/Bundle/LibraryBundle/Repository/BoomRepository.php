<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Boom\Bundle\LibraryBundle\Entity\Category;
use Boom\Bundle\LibraryBundle\Entity\Tag;
use Boom\Bundle\LibraryBundle\Entity\Boom;

class BoomRepository extends NestedTreeRepository {

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
        return $aResultTotal[0][1];
    }

    public function findBoomsByCategory(Category $category, $sort = array('date_created' => 'DESC'), $limit = 7, $offset = 0, array $status = array()) {

        $sortKey = \key($sort);
        $sortValue = \current($sort);

        $statusFilter = $this->validateStatus($status);

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
        $query->setParameters(array('category' => $category, 'status' => $statusFilter));
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);
        $result = $query->execute();

        return $result;
    }

    public function totalBoomsByCategory(Category $category, array $status = array()) {

        $statusFilter = $this->validateStatus($status);

        $qString = "
            SELECT
                count(boom)
            FROM
                BoomLibraryBundle:Boom boom
            LEFT JOIN
                boom.category category
            WHERE
                boom.category = :category
            AND
                boom.status IN (:status)";

        $em = $this->getEntityManager();
        $query = $em->createQuery($qString);
        $query->setParameters(array('category' => $category, 'status' => $statusFilter));
        $result = $query->getSingleScalarResult();

        return $result;
    }

    public function findBoomsByTag(Tag $tag, $sort = array('date_created' => 'DESC'), $limit = 7, $offset = 0, array $status = array()) {

        $sortKey = \key($sort);
        $sortValue = \current($sort);

        $statusFilter = $this->validateStatus($status);

        $qString = "
            SELECT
                boom
            FROM
                BoomLibraryBundle:Boom boom
            LEFT JOIN
                boom.tags tag
            WHERE
                :tag
            MEMBER OF
                boom.tags
            AND
                boom.status IN (:status)
            ORDER BY boom.{$sortKey} {$sortValue}";

        $em = $this->getEntityManager();
        $query = $em->createQuery($qString);
        $query->setParameters(array('tag' => $tag, 'status' => $status));
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);
        $result = $query->execute();

        return $result;
    }

    public function totalBoomsByTag(Tag $tag, array $status = array()) {

        $statusFilter = $this->validateStatus($status);

        $qString = "
            SELECT
                count(boom)
            FROM
                BoomLibraryBundle:Boom boom
            LEFT JOIN
                boom.tags tags
            WHERE
                :tag
            MEMBER OF
                boom.tags
            AND
                boom.status IN (:status)";

        $em = $this->getEntityManager();
        $query = $em->createQuery($qString);
        $query->setParameters(array('tag' => $tag, 'status' => $statusFilter));
        $result = $query->getSingleScalarResult();

        return $result;
    }

    public function validateStatus(array $status = array()) {

        $statusFilter = array();
        $statusOptions = Boom::getStatusEnumFieldValues();

        if (empty($status)) {
            $status[] = Boom::STATUS_PUBLIC;
        }
        foreach ($status as $stat) {
            if (in_array($stat, $statusOptions)) {
                $statusFilter[] = $stat;
            }
        }

        return $statusFilter;
    }

}