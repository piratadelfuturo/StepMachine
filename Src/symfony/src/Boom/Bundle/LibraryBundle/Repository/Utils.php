<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of Utils
 *
 * @author daniel
 */
class Utils {

    static function processAjaxTable($repo, array $get, $flag = false) {

        /* Indexed column (used for fast and accurate table cardinality) */
        $alias = 'a';

        /* DB table to use */
        $tableObjectName = $repo->getClassName();


        if (!isset($get['columns']) || is_null($get['columns']) || empty($get['columns'])) {
            $columns = array('id');
        } else {
            $columns = $get['columns'];
        }

        $joins = array($tableObjectName => $alias);

        $finalColumns = array();

        $aColumns = array();
        foreach ($columns as $value) {
            if (!is_array($value)) {
                $columnAlias = explode(' ', $value);
                if (count($columnAlias) > 1) {
                    $value = $columnAlias[0];
                    $columnAlias = $columnAlias[1];
                } else {
                    $columnAlias = $value;
                }

                $columnName = $alias . '.' . $value;
                $nameAdd = 1;
                while (in_array($columnAlias, $finalColumns)) {
                    $columnAlias = $value . '_' . $nameAdd;
                }
                $finalColumns[$columnName] = $columnAlias;
                $aColumns[] = $columnName . ' ' . $columnAlias;
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

                    foreach ($subColumn as $subKey => $subValue) {
                        $replacePattern = null;
                        if (is_string($subKey)) {
                            $replacePattern = $subValue;
                            $subValue = $subKey;
                        }
                        $subDisplayAlias = explode(' ', $subValue);
                        if (count($subDisplayAlias) > 1) {
                            $subValue = $subDisplayAlias[0];
                            $subDisplayAlias = $subDisplayAlias[1];
                        } else {
                            $subDisplayAlias = $subDisplayAlias[0];
                        }
                        $subColumnValue = $subAlias . '.' . $subValue;

                        $nameAdd = 1;
                        while (in_array($subDisplayAlias, $finalColumns)) {
                            $subDisplayAlias = $subValue . '_' . $nameAdd;
                        }

                        if (!is_null($replacePattern)) {
                            $subColumnValue = sprintf($replacePattern, $subColumnValue);
                        }
                        $finalColumns[$subColumnValue] = $subDisplayAlias;
                        $aColumns[] = $subColumnValue . ' '.$subDisplayAlias;
                    }
                }
            }
        }
        array_shift($joins);

        $finalColumnNames = array_values($finalColumns);
        $finalColumnKeys = array_keys($finalColumns);

        $cb = $repo->createQueryBuilder($alias);
        $cb->select(implode(', ', $aColumns));

        $countValue = $alias . '.id';

        $cb->groupBy($countValue);

        $cb2 = $repo->createQueryBuilder($alias)
                ->select("COUNT($countValue)");


        if (!empty($joins)) {
            foreach ($joins as $joinkey => $joinAlias) {
                $cb->leftJoin(
                        $joinkey, $joinAlias
                );
                $cb2->leftJoin(
                        $joinkey, $joinAlias
                );
            }
        }

        /*
         * Ordering
         */
        if (isset($get['iSortCol_0'])) {
            for ($i = 0; $i < intval($get['iSortingCols']); $i++) {
                if ($get['bSortable_' . intval($get['iSortCol_' . $i])] == "true") {
                    $orderColumn = explode(' ', $finalColumnNames[(int) $get['iSortCol_' . $i]]);
                    $orderColumn = end($orderColumn);
                    $cb->orderBy($orderColumn, $get['sSortDir_' . $i]);
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
            for ($i = 0; $i < count($finalColumnNames); $i++) {
                if (isset($get['bSearchable_' . $i]) && $get['bSearchable_' . $i] == "true") {
                    $cb->orWhere($cb->expr()->like($finalColumnKeys[$i], '\'%' . $get['sSearch'] . '%\''));
                    $cb2->orWhere($cb2->expr()->like($finalColumnKeys[$i], '\'%' . $get['sSearch'] . '%\''));
                }
            }
        }

        if (isset($get['iDisplayStart']) && $get['iDisplayLength'] != '-1') {
            $cb->setFirstResult((int) $get['iDisplayStart'])
                    ->setMaxResults((int) $get['iDisplayLength']);
        }


        $query2 = $cb2->getQuery()->getSingleResult();

        $query2 = is_array($query2) ? current($query2) : null;

        /*
         * SQL queries
         * Get data to display
         */
        $query = $cb->getQuery();

        if ($flag) {
            $query = $query;
        } else {
            $query = $query->getResult();
        }


        return array(
            'total' => $query2,
            'query' => $query
        );
    }

}
