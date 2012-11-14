<li class="add-boom">
    <?php if ($act['self'] === false): ?>
        <p class="info"><a href="<?php echo $act['profile_url'] ?>"><?php echo $view->escape($act['user']['name']) ?></a> ha creado un nuevo boom:</p>
    <?php else: ?>
        <p class="info">Publiqu&eacute; un nuevo boom:</p>
    <?php endif; ?>
    <p class="title">
        <a href="<?php echo $act['boom_url'] ?>"><?php echo $view->escape($act['boom_title']) ?></a>
    </p><date><?php echo $view->escape($act['date']) ?></date>
</li>
