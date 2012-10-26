<?php

namespace Boom\Bundle\FrontBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PaginationHelper extends Helper {

    public function paginationValues($total, $page = 1, $limit = 10, $segment_pages_limit = 7) {
        $pages = array();
        $total_pages = ceil($total / $limit);
        $total_fractions = ceil($total_pages / $segment_pages_limit);
        $fraction = ceil( $page / $segment_pages_limit);

        if ($total > $limit) {
                $last_segment = $fraction * $segment_pages_limit;
                $first_segment = ($last_segment - $segment_pages_limit) + 1;
                if($last_segment > $total_pages){
                    $last_segment = $total_pages;
                }
                var_dump($first_segment, $last_segment);
                $pages = range(
                        $first_segment, $last_segment
                );
        }

        $return = array(
            'page'          => $page,
            'total_pages'   => $total_pages,
            'segment_pages'     => $pages,
            'max_segment_pages' => $total_fractions
        );

        return $return;
    }

    public function getName() {
        return 'boom_pagination';
    }

}