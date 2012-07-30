<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class BoomRepository extends EntityRepository {

    /**
     * @param array $get
     * @param bool $flag
     * @return array|\Doctrine\ORM\Query
     */
    public function ajaxTable(array $get, $flag = false) {

        /* Indexed column (used for fast and accurate table cardinality) */
        $alias = 'a';

        /* DB table to use */
        $tableObjectName = $this->getEntityName();

        $joins = array($tableObjectName => $alias);

        /**
         * Set to default
         */
        if (!isset($get['columns']) || empty($get['columns']))
            $get['columns'] = array('id');

        $aColumns = array();
        foreach ($get['columns'] as $value) {
            if (!is_array($value)) {
                $aColumns[] = $alias . '.' . $value;
            } else {
                foreach ($value as $subKey => $subColumn) {
                    if (!isset($joins[$alias . '.' . $subKey])) {

                        $aliasCount = 0;
                        do {
                            $aliasCount++;
                            $subAlias = substr($subKey, 0, $aliasCount);
                        } while (in_array($subAlias, $joins));

                        $joins[$alias . '.' . $subKey] = $subAlias;
                    }
                    $subAlias = $joins[$alias . '.' . $subKey];

                    foreach ($subColumn as $subValue) {
                        $aColumns[] = $subAlias . '.' . $subValue;
                    }
                }
            }
        }
        array_shift($joins);

        $cb = $this->createQueryBuilder($alias)
                ->select(str_replace(" , ", " ", implode(", ", $aColumns)));

        if (!empty($joins)) {
            foreach ($joins as $joinkey => $joinAlias) {
                $cb->leftJoin(
                        $joinkey, $joinAlias
                );
            }
        }

        if (isset($get['iDisplayStart']) && $get['iDisplayLength'] != '-1') {
            $cb->setFirstResult((int) $get['iDisplayStart'])
                    ->setMaxResults((int) $get['iDisplayLength']);
        }


        /*
         * Ordering
         */
        if (isset($get['iSortCol_0'])) {
            for ($i = 0; $i < intval($get['iSortingCols']); $i++) {
                if ($get['bSortable_' . intval($get['iSortCol_' . $i])] == "true") {
                    $cb->orderBy($aColumns[(int) $get['iSortCol_' . $i]], $get['sSortDir_' . $i]);
                }
            }
        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if (isset($get['sSearch']) && $get['sSearch'] != '') {
            $aLike = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if (isset($get['bSearchable_' . $i]) && $get['bSearchable_' . $i] == "true") {
                    $cb->orWhere($cb->expr()->like($aColumns[$i], '\'%' . $get['sSearch'] . '%\''));
                }
            }
            if (count($aLike) > 0){
                //$cb->andWhere($cb->expr()->orX($aLike));
            }else{
                unset($aLike);
            }
        }

        /*
         * SQL queries
         * Get data to display
         */
        $query = $cb->getQuery();

        if ($flag)
            return $query;
        else
            return $query->getResult();
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