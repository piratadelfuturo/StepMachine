<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\User;

class UserRepository extends EntityRepository {

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

    public function getLatestCollaborators($number = 7) {
        $qString = "
            SELECT
                user user_record,
                boom.title boom_title,
                boom.slug boom_slug,
                category.slug category_slug,
                boom.date_published date_published
            FROM
                BoomLibraryBundle:User user
            LEFT JOIN
                user.booms boom
            LEFT JOIN
                boom.category category
            WHERE
                boom.status = ?0
            AND
                user.collaborator = true
            ORDER BY date_published DESC";

        $em = $this->getEntityManager();
        $query = $em->createQuery($qString);
        $query->setParameters(array(Boom::STATUS_PUBLIC));
        $query->setFirstResult(0);
        $query->setMaxResults($number);
        $query->useResultCache(
                true, 10, implode(
                        '_', array(
                    'front_user_collaborators_widget',
                    Boom::STATUS_PUBLIC,
                    $number
                        )
                )
        );

        $result = $query->execute();

        return $result;
    }

    public function getFollowedActivities(User $user, $offset = 0, $limit = 14) {
        /* @var Doctrine\ORM\Query $query */
        $cb1 = $this->createQueryBuilder('u');
        $cb1->select('
            friend.id
            ');
        $cb1->join('u.following', 'friend');
        $cb1->where(
                $cb1->expr()->eq('u.id', ':user_id')
        );

        $cb2 = $this->_em->createQueryBuilder();
        $cb2->select('activity')
                ->from('BoomLibraryBundle:Activity', 'activity');
        $cb2->join('activity.user', 'user');
        $cb2->leftJoin('activity.boom', 'boom');
        $cb2->leftJoin('boom.category', 'category');
        $cb2->where(
                $cb2->expr()->in(
                        'user.id', $cb1->getDQL()
                )
        );
        $cb2->setFirstResult((int) $offset)->setMaxResults((int) $limit);
        $cb2->orderBy('activity.date', 'DESC');
        $cb2->setParameter('user_id', $user['id']);

        $query = $cb2->getQuery();
        $query->useResultCache(
                true, 120, implode(
                        '_', array(
                    'front_user_activities_cache',
                    $user['id'],
                    $offset,
                    $limit
                        )
                )
        );
        $result = $query->getResult();
        return $result;
    }

    public function checkFollowStatus($username, $friend_username) {
        /* @var Doctrine\ORM\Query $query */
        $cb = $this->createQueryBuilder('user');
        $cb->select('
            friend.id friend_id
            ');
        $cb->leftJoin('user.following', 'friend');
        $cb->andWhere(
                $cb->expr()->eq('user.username', ':username'), $cb->expr()->eq('friend.username', ':friend_username')
        );
        $cb->setFirstResult(0)->setMaxResults(1);
        $cb->setParameter('username', $username);
        $cb->setParameter('friend_username', $friend_username);
        $query = $cb->getQuery();
        try {
            $result = $query->getSingleScalarResult();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getFollowers(User $user, $offset = 0, $limit = 14) {
        $cb = $this->createQueryBuilder('user');
        $cb->select('user');
        $cb->leftJoin('user.following', 'following');
        $cb->andWhere(
                $cb->expr()->eqs('following.id', ':user_id')
        );
        $cb->setFirstResult($offset)->setMaxResults($limit);
        $cb->setParameter('user_id', $user['id']);
        $query = $cb->getQuery();
        $result = $query->getResult();
        return $result;
    }

    public function totalFollowers(User $user) {
        return $user['followers']->count();
    }

    public function getFollowing(User $user, $offset = 0, $limit = 14) {
        $cb = $this->createQueryBuilder('user');
        $cb->select('user');
        $cb->leftJoin('user.followers', 'follower');
        $cb->andWhere(
                $cb->expr()->eq('follower.id', ':user_id')
        );
        $cb->setFirstResult($offset)->setMaxResults($limit);
        $cb->setParameter('user_id', $user['id']);
        $query = $cb->getQuery();
        $result = $query->getResult();
        return $result;
    }

    public function totalFollowing(User $user) {
        return $user['following']->count();
    }

}