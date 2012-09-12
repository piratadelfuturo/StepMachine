<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Boom\Bundle\LibraryBundle\Entity\Boom;

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


    public function getLatestCollaborators($number = 7){
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
        $result = $query->execute();

        return $result;



    }

}