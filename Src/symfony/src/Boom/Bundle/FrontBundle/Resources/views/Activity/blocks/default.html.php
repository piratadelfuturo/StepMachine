<li class="add-boom">
    <?php if ($act['self'] === false): ?>
        <p class="info"><a href="<?php echo $act['profile_url'] ?>"> <?php echo $view->escape($act['user']['name']) ?> </a> <?php echo $view->escape((string) $entity['data']) ?></p>
    <?php else: ?>
        <p class="info"><?php echo $view->escape((string) $entity['data']) ?> <a href="<?php echo $act['profile_url'] ?>"> <?php echo $view->escape($entity['user']['name']) ?></a>:</p>
    <?php endif; ?>
    <?php if ($entity['boom'] !== null): ?>
        <p class="title">
            <a href="<?php echo $act['boom_url'] ?>"><?php echo $view->escape($act['boom_title']) ?></a>
        </p>
    <?php endif; ?>
<date><?php echo $view->escape($act['boom_date']) ?></date>
</li>