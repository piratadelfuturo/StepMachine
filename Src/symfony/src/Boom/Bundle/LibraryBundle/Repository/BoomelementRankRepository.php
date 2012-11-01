<?php

namespace Boom\Bundle\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Boom\Bundle\LibraryBundle\Entity\Boom;

class BoomelementRankRepository extends EntityRepository {

    public function calculatePublicRank(Boom $boom){
        /*
        $rank = 'Select boom_id, position, count(*) as counter, boomelement_id
from boomelement_rank
where boom_id = 3
group by boomelement_id, position
order by position ASC, counter DESC'; */

        /* @var Doctrine\ORM\Query $query */
        $cb = $this->createQueryBuilder('rank');
        $cb->select('
                boom.id boom_id,
                rank.position position,
                count(rank.user) counter,
                element.id element_id
            ');
        $cb->join('rank.boom', 'boom');
        $cb->join('rank.boomelement', 'element');
        $cb->where(
                $cb->expr()->eq('boom.id', ':boom_id')
        );
        $cb->addGroupBy('element_id');
        $cb->addGroupBy('position');
        $cb->addOrderBy('position', 'ASC');
        $cb->addOrderBy('counter', 'DESC');
        $query = $cb->getQuery();
        $query->setParameter('boom_id', $boom['id']);
        $result = $query->getResult();
        if(!empty($result)){
            $finalRanks = $newRanks = array();
            $comunity_position = 1;
            foreach($result as $row){
                $newRanks[$row['position']][$row['element_id']] = $row['counter'];
            }
            foreach($newRanks as $position => $element){
                foreach($element as $element_id => $count){
                    if(!isset($finalRanks[$element_id])){
                        $finalRanks[$element_id] = $comunity_position++;
                        continue 2;
                    }
                }
            }
            $boomelementsRefs = array();
            foreach($boom['elements']->toArray() as $boomelement){
                if(isset($finalRanks[$boomelement['id']])){
                    $boomelement['communityposition'] = $finalRanks[$boomelement['id']];
                    $boomelementsRefs[] = $boomelement;
                    $this->_em->persist($boomelement);
                }
            }
            $this->_em->flush();
        }
        return $boom;
    }

}