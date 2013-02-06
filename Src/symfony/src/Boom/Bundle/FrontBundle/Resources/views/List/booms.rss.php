<?php
$view->extend('BoomFrontBundle::layout.rss.php');
$view['slots']->set('title','7boom');
$view['slots']->set('link','http://7boom.mx');
foreach ($list as $element): ?>
    <item>
        <title><?php echo $view->escape($element['title']) ?></title>
        <link><?php
    echo $view['router']->generate(
            'BoomFrontBundle_boom_show', array(
        'category_slug' => $element['category']['slug'],
        'slug' => $element['slug']
            ), true
    );
    ?></link>
        <description><?php echo $view->escape($element['summary']) ?></description>
    </item>
<?php endforeach; ?>