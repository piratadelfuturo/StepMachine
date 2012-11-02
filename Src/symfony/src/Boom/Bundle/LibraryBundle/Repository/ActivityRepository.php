<?php
namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Boom\Bundle\LibraryBundle\Entity\User;

class ActivityRepository extends EntityRepository {

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

    public function getFollowedActivities(User $user, $offset = 0, $limit = 14) {
        /* @var Doctrine\ORM\Query $query */
        $cb = $this->createQueryBuilder('activity');
        $cb->select('
                activity
            ');
        //$cb->join('friend.activities', 'activity');
        $cb->leftJoin('activity.user', 'user');
        $cb->leftJoin('user.followers', 'follower');
        $cb->leftJoin('activity.boom', 'boom');
        $cb->leftJoin('boom.category', 'category');
        $cb->andWhere(
                $cb->expr()->eq('follower.id', ':user_id')
        );
        $cb->setFirstResult($offset)->setMaxResults((int) $limit);
        $cb->orderBy('activity.date', 'DESC');
        $cb->setParameter('user_id', $user['id']);
        $query = $cb->getQuery();
        //$query->useResultCache(true, 120, 'front_user_activities_cache_'.$user['id'].'_'.$limit);
        $result = $query->getResult();

        return $result;
    }

}