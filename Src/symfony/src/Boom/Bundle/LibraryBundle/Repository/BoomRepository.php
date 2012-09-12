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

    public function findBoomsByCategory(Category $category, $sort = array('boom.date_published' => 'DESC'), $limit = 7, $offset = 0, array $status = array(), $featured = false) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('boom');
        $cb->leftJoin('boom.category', 'category');
        $cb->andWhere(
                $cb->expr()->eq('boom.category', $category['id']), $cb->expr()->in('boom.status', $statusFilter)
        );
        if ($featured == true) {
            $cb->andWhere(
                    $cb->expr()->isNotNull('boom.featured')
            );
            $cb->orderBy('boom.featured', 'DESC');
        } else {
            foreach ($sort as $aSortKey => $aSortValue) {
                $cb->orderBy($aSortKey, $aSortValue);
            }
        }
        $cb->setFirstResult((int) $offset)->setMaxResults((int) $limit);

        $query = $cb->getQuery();
        $result = $query->execute();

        return $result;
    }

    public function totalBoomsByCategory(Category $category, array $status = array(), $featured = false) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('count(boom)');
        $cb->leftJoin('boom.category', 'category');
        $cb->andWhere(
                $cb->expr()->eq('boom.category', $category['id']), $cb->expr()->in('boom.status', $statusFilter)
        );
        if ($featured == true) {
            $cb->andWhere(
                    $cb->expr()->isNotNull('boom.featured')
            );
        }

        $query = $cb->getQuery();
        $result = $query->getSingleScalarResult();

        return $result;
    }
    public function findUserBoomsByCategory(Category $category, $sort = array('boom.date_published' => 'DESC'), $limit = 7, $offset = 0, array $status = array(), $featured = false, $collaborator = false) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('boom');
        $cb->leftJoin('boom.category', 'category');
        $cb->leftJoin('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('boom.category', $category['id']),
                $cb->expr()->eq('user.collaborator', (int) $collaborator),
                $cb->expr()->in('boom.status', $statusFilter)
        );
        if ($featured == true) {
            $cb->andWhere(
                    $cb->expr()->isNotNull('boom.featured')
            );
            $cb->orderBy('boom.featured', 'DESC');
        } else {
            foreach ($sort as $aSortKey => $aSortValue) {
                $cb->orderBy($aSortKey, $aSortValue);
            }
        }
        $cb->setFirstResult((int) $offset)->setMaxResults((string) $limit);

        $query = $cb->getQuery();
        $result = $query->execute();

        return $result;
    }

    public function totalUserBoomsByCategory(Category $category, array $status = array(), $featured = false, $collaborator = false) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('count(boom)');
        $cb->leftJoin('boom.category', 'category');
        $cb->leftJoin('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('boom.category', $category['id']),
                $cb->expr()->eq('user.collaborator', (string) $collaborator),
                $cb->expr()->in('boom.status', $statusFilter)
        );
        if ($featured == true) {
            $cb->andWhere(
                    $cb->expr()->isNotNull('boom.featured')
            );
        }

        $query = $cb->getQuery();
        $result = $query->getSingleScalarResult();

        return $result;
    }

    public function findFeaturedBooms($sort = array('boom.date_published' => 'DESC'), $limit = 7, $offset = 0, array $status = array()) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('boom');
        $cb->andWhere(
                $cb->expr()->in('boom.status', $statusFilter), $cb->expr()->isNotNull('boom.featured')
        );
        $cb->orderBy('boom.featured', 'DESC');
        $cb->orderBy($aSortKey, $aSortValue);
        $cb->setFirstResult((int) $offset)->setMaxResults((int) $limit);
        $query = $cb->getQuery();
        $result = $query->execute();

        return $result;
    }

    public function totalFeaturedBooms(array $status = array()) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('count(boom)');
        $cb->andWhere(
                $cb->expr()->in('boom.status', $statusFilter)
        );
        $cb->andWhere(
                $cb->expr()->isNotNull('boom.featured')
        );

        $query = $cb->getQuery();
        $result = $query->getSingleScalarResult();

        return $result;
    }

    public function findBoomsByTag(Tag $tag, $sort = array('date_published' => 'DESC'), $limit = 7, $offset = 0, array $status = array()) {

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
        $query->setParameters(array('tag' => $tag, 'status' => $statusFilter));
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

    public function findUsersBooms($sort = array('boom.date_published' => 'DESC'), $limit = 7, $offset = 0, array $status = array(),$featured = false, $collaborator = false) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('boom');
        $cb->leftJoin('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('user.collaborator', (int) $collaborator),
                $cb->expr()->in('boom.status', $statusFilter)
        );
        if ($featured == true) {
            $cb->andWhere(
                    $cb->expr()->isNotNull('boom.featured')
            );
            $cb->orderBy('boom.featured', 'DESC');
        } else {
            foreach ($sort as $aSortKey => $aSortValue) {
                $cb->orderBy($aSortKey, $aSortValue);
            }
        }
        $cb->setFirstResult((int) $offset)->setMaxResults((int) $limit);

        $query = $cb->getQuery();
        $result = $query->execute();

        return $result;
    }

    public function totalUsersBooms( array $status = array(), $featured = false, $collaborator = false) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('count(boom)');
        $cb->leftJoin('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('user.collaborator', (int) $collaborator),
                $cb->expr()->in('boom.status', $statusFilter)
        );
        if ($featured == true) {
            $cb->andWhere(
                    $cb->expr()->isNotNull('boom.featured')
            );
        }

        $query = $cb->getQuery();
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

    public function findBoomsByLike($query = '', $limit = 7, $offset = 0) {

        $qString = "
            SELECT
                boom.title,
                boom.summary,
                boom.slug,
                category.name category_name,
                category.slug category_slug,
                boom.id id,
                image.id image_id,
                category.id category_id
            FROM
                BoomLibraryBundle:Boom boom
            LEFT JOIN
                boom.category category
            LEFT JOIN
                boom.image image
            WHERE
                boom.title LIKE '%{$query}%'
            AND
                boom.status IN (:status)
            ORDER BY boom.date_published DESC";

        $em = $this->getEntityManager();
        $query = $em->createQuery($qString);
        $query->setParameters(array('status' => Boom::STATUS_PUBLIC));
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);
        $result = $query->getScalarResult();

        return $result;
    }

    public function findLatestBooms($sort = array('boom.date_published' => 'DESC'), $limit = 7, $offset = 0, array $status = array()){

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('boom');
        $cb->andWhere(
                $cb->expr()->in('boom.status', $statusFilter)
        );
        foreach ($sort as $aSortKey => $aSortValue) {
            $cb->orderBy($aSortKey, $aSortValue);
        }

        $cb->setFirstResult((int) $offset)->setMaxResults((int) $limit);

        $query = $cb->getQuery();
        $result = $query->getSingleScalarResult();

        return $result;

    }

    public function totalLatestBooms(array $status = array()){

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('count(boom)');
        $cb->andWhere(
                $cb->expr()->in('boom.status', $statusFilter)
        );

        $query = $cb->getQuery();
        $result = $query->getSingleScalarResult();

        return $result;

    }

}