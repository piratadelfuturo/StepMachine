<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['slots']->set('layout_container_css_class','category category-'.$category['slug']); ?>
<?php echo $view->render('BoomFrontBundle:Category:blocks/top.html.php', array(
            'title' => 'top semanal',
            'category' => $category
                ));
?>

    <?php echo $view->render('BoomFrontBundle:Boom:blocks/block_list.html.php', array(
            'title' => 'top semanal',
            'category' => $category
                ));
?>

    <?php echo $view->render('BoomFrontBundle:Boom:blocks/long_list.html.php', array(
            'title' => 'ÚLTIMOS',
            'category' => $category,
            'list' => $latest
                ));
?>

    <?php /* ?><table class="records_list">
    <thead>
        <tr>
            <th>Id</th>
            <th>Slug</th>
            <th>Title</th>
            <th>Summary</th>
            <th>Date_created</th>
            <th>Date_published</th>
            <th>Nsfw</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php //print_r(count($entities)); ?>
        <?php foreach($entities as $entity):?>
        <tr>
            <td><a href="<?php echo $view['router']->generate('boom_show', array('id' => $entity->getId())); ?>"><?php echo $view->escape($entity->getId()) ?></a></td>
            <td><?php echo $view->escape($entity->getSlug()) ?></td>
            <td><?php echo $view->escape($entity->getTitle()) ?></td>
            <td><?php echo $view->escape($entity->getId()) ?></td>
            <td>
                <?php !is_null($entity->getDatecreated()) ? var_dump($entity->getDatecreated()) : ''?>
            </td>
            <td>
                <?php !is_null($entity->getDatepublished()) ? var_dump($entity->getDatepublished()) : ''?>
            </td>
            <td>{{ entity.nsfw }}</td>
            <td>
                <ul>
                    <li>
                        <a href="{{ path('boom_show', { 'id': entity.id }) }}">show</a>
                    </li>
                    <li>
                        <a href="{{ path('boom_edit', { 'id': entity.id }) }}">edit</a>
                    </li>
                </ul>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<ul>
    <li>
        <a href="<?php echo $this['router']->generate('boom_show', array('id' => $entity->getId())); ?>">
            Create a new entry
        </a>
    </li>
</ul>
<?php */ ?>
