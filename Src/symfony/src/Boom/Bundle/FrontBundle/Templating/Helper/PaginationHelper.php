<?php

namespace Boom\Bundle\FrontBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Bundle\FrameworkBundle\Templating\DelegatingEngine;

class PaginationHelper extends Helper {

    protected $templating;

    public function __construct(DelegatingEngine $templating) {
        $this->templating = $templating;
    }

    public function paginationValues($total, $page = 1, $limit = 10, $segment_pages_limit = 7) {
        $pages = array();
        $total_pages = ceil($total / $limit);
        $total_fractions = ceil($total_pages / $segment_pages_limit);
        $fraction = ceil($page / $segment_pages_limit);

        if ($total > $limit) {
            $last_segment = $fraction * $segment_pages_limit;
            $first_segment = ($last_segment - $segment_pages_limit) + 1;
            if ($last_segment > $total_pages) {
                $last_segment = $total_pages;
            }
            var_dump($first_segment, $last_segment);
            $pages = range(
                    $first_segment, $last_segment
            );
        }

        $return = array(
            'page' => $page,
            'total_pages' => $total_pages,
            'segment_pages' => $pages,
            'max_segment_pages' => $total_fractions
        );

        return $return;
    }

    public function renderPaginationBlock($route_name, array $route_params, $total, $page = 1, $limit = 10, $segment_pages_limit = 7) {
        $pagination = $this->paginationValues($total, $page, $limit, $segment_pages_limit);
        return $this->templating->render(
                        'BoomFrontBundle:List:blocks/pagination.html.php', array(
                    'pagination' => $pagination,
                    'page' => $page,
                    'total' => $total,
                    'route_name' => $route_name,
                    'route_params' => $route_params
                        )
        );
    }

    public function getName() {
        return 'boom_pagination';
    }

}