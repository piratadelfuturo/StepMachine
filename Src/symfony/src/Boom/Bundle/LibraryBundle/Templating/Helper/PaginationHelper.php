<?php

namespace Boom\Bundle\LibraryBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PaginationHelper extends Helper {

    public function paginationValues($page, $total, $limit = 10, $max_segment_pages = 8) {
        $max_segment_pages = $max_segment_pages;
        $limit = $limit;
        $pages = array();
        $total_pages = 1;

        if ($total > $limit) {
            $total_pages = $total / $limit;
            if ($total_pages <= $max_segment_pages) {
                $fraction = 1;
                $pages = range(1, $total_pages);
            } else {
                $fraction = floor($page / $max_segment_pages);
                $last_segment = ($fraction * $max_segment_pages) + $max_segment_pages;
                $last_segment = $fraction == floor($total_pages / $max_segment_pages) ? $total_pages : $last_segment;

                $pages = range(
                        $fraction * $max_segment_pages, $last_segment
                );
            }
        }

        $return = array(
            'page'          => $page,
            'total_pages'   => $total_pages,
            'pages'         => $pages,
            'max_segment_pages' => $max_segment_pages
        );

        return $return;
    }

    public function getName() {
        return 'boom_image';
    }

}