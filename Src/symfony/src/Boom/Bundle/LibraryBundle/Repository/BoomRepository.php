<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Boom\Bundle\LibraryBundle\Entity\Category;
use Boom\Bundle\LibraryBundle\Entity\Tag;
use Boom\Bundle\LibraryBundle\Entity\User;
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

    public function findUsersBoomsByCategory(Category $category, $sort = array('boom.date_published' => 'DESC'), $limit = 7, $offset = 0, array $status = array(), $featured = false, $collaborator = false) {

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

    public function findBoomsByUser(User $user, $modified = false, array $status = array(), $limit = 7, $offset = 0,  $sort = array('boom.date_published' => 'DESC')) {

        $statusFilter = $this->validateStatus($status);
        $cb = $this->createQueryBuilder('boom');
        $cb->select('boom');
        $cb->leftJoin('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('user.id', $user['id']),
                $cb->expr()->in('boom.status', $statusFilter)
        );
        if ($modified == true) {
            $cb->andWhere(
                    $cb->expr()->isNotNull('boom.parent')
            );
        } else {
            $cb->andWhere(
                    $cb->expr()->isNull('boom.parent')
            );
        }
        foreach ($sort as $aSortKey => $aSortValue) {
            $cb->orderBy($aSortKey, $aSortValue);
        }
        $cb->setFirstResult((int) $offset)->setMaxResults((string) $limit);

        $query = $cb->getQuery();
        $result = $query->execute();

        return $result;
    }

    public function totalBoomsByUser(User $user, $modified = false, array $status = array()) {
        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('count(boom)');
        $cb->leftJoin('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('user.id', $user['id']),
                $cb->expr()->in('boom.status', $statusFilter)
        );
        if ($modified == true) {
            $cb->andWhere(
                    $cb->expr()->isNotNull('boom.parent')
            );
        } else {
            $cb->andWhere(
                    $cb->expr()->isNull('boom.parent')
            );
        }

        $query = $cb->getQuery();
        $result = $query->getSingleScalarResult();

        return $result;
    }

    public function totalUsersBoomsByCategory(Category $category, array $status = array(), $featured = false, $collaborator = false) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('count(boom)');
        $cb->leftJoin('boom.category', 'category');
        $cb->leftJoin('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('boom.category', $category['id']), $cb->expr()->eq('user.collaborator', (string) $collaborator), $cb->expr()->in('boom.status', $statusFilter)
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
                $cb->expr()->in('boom.status', ':status'), $cb->expr()->isNotNull('boom.featured')
        );
        $cb->orderBy('boom.featured', 'DESC');
        $cb->orderBy('boom.date_published', 'DESC');
        $cb->setFirstResult((int) $offset)->setMaxResults((int) $limit);
        foreach ($sort as $aSortKey => $aSortValue) {
            $cb->orderBy($aSortKey, $aSortValue);
        }

        $query = $cb->getQuery();
        $query->setParameters(array('status' => $statusFilter));
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

    public function findUsersBooms($sort = array('boom.date_published' => 'DESC'), $limit = 7, $offset = 0, array $status = array(), $featured = false, $collaborator = false) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('boom');
        $cb->leftJoin('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('user.collaborator', ':collaborator'),
                $cb->expr()->in('boom.status', ':status')
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
        $query->setParameters(
                array(
                    'collaborator'  => $collaborator,
                    'status'        => $statusFilter
                )
                );


        $result = $query->execute();

        return $result;
    }

    public function totalUsersBooms(array $status = array(), $featured = false, $collaborator = false) {

        $statusFilter = $this->validateStatus($status);

        $cb = $this->createQueryBuilder('boom');
        $cb->select('count(boom)');
        $cb->leftJoin('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('user.collaborator', (int) $collaborator), $cb->expr()->in('boom.status', $statusFilter)
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
                image.path image_path,
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

    public function findLatestBooms($sort = array('boom.date_published' => 'DESC'), $limit = 7, $offset = 0, array $status = array()) {

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
        $result = $query->execute();

        return $result;
    }

    public function totalLatestBooms(array $status = array()) {

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

    public function isFavoriteUser(Boom $boom, User $user) {

        $cb = $this->createQueryBuilder('boom');
        $cb->select('boom.id');
        $cb->join('boom.favorite_users', 'favorite');
        $cb->andWhere(
                $cb->expr()->eq('boom.id', $boom['id']), $cb->expr()->in('favorite.id', $user['id'])
        );
        $query = $cb->getQuery();
        $result = (bool) $query->getScalarResult();
        return $result;
    }

    public function getUserBoomReply(User $user,Boom $boom){

        $cb = $this->createQueryBuilder('boom');
        $cb->select('boom');
        $cb->join('boom.parent', 'parent');
        $cb->join('boom.user', 'user');
        $cb->andWhere(
                $cb->expr()->eq('parent.id', ':boom_id'),
                $cb->expr()->eq('user.id', ':user_id')
        );
        $cb->setFirstResult(0)->setMaxResults(1);

        $query = $cb->getQuery();
        $query->setParameter('user_id', $user['id']);
        $query->setParameter('boom_id', $boom['id']);
        $result = $query->getOneOrNullResult();
        return $result;

    }

}