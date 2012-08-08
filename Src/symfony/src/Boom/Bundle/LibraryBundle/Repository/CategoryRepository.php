<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class CategoryRepository extends EntityRepository {

    public function findBoomsByCategory($category, $field = 'date_created', $order = 'DESC', $limit = 7, $offset = 0) {
        $qString = "
            SELECT
                boom,
                image.path    image_path,
                category.name category_name,
                category.slug category_slug,
                user.username user_username,
                user.nickname user_nickname
            FROM
                BoomLibraryBundle:Boom boom
            LEFT JOIN
                boom.categories category
            LEFT JOIN
                boom.user user
            LEFT JOIN
                boom.image image
            WHERE
                ?0
            MEMBER OF
                boom.categories
            ORDER BY boom.{$field} {$order}";

        $em = $this->getEntityManager();
        $query = $em->createQuery($qString);
        $query->setParameters(array($category));
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);
        $query->setHydrationMode(Query::HYDRATE_SCALAR);
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
        return $aResultTotal[0][1];
    }

}