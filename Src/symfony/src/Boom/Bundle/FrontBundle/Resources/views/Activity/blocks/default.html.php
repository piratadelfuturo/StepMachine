<li class="add-boom">
    <p class="info">
        <?php if($entity['user']['id'] !== $app->getUser()-getId()): ?>
        <a href="<?php
echo $view['router']->generate(
        'BoomFrontBundle_user_profile', array('username' => $entity['user']['username'])
);
?>"><?php echo $view->escape($entity['user']['name']) ?></a>
        <?php endif; ?>
    <?php echo $view->escape($entity['data']) ?>
    </p>
    <p class="title">
        <a href="<?php
        echo $view['router']->generate(
                'BoomFrontBundle_boom_show', array(
            'category_slug' => $entity['boom']['category']['slug'], 'slug' => $entity['boom']['slug']
                )
        )
        ?>"><?php echo $view->escape($entity['boom']['title']) ?></a>
    </p>
<date><?php echo $view->escape($view['boom_front']->getLocaleFormatDate($element['date'], 'EEE, d MMM, yyyy')) ?></date>
</li>