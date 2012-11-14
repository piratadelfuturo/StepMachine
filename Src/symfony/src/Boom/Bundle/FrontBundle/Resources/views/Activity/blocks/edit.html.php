<li class="add-boom">
    <?php if ($act['self'] === false): ?>
        <p class="info"><a href="<?php echo $act['profile_url'] ?>"><?php echo $view->escape($act['user']['name']) ?></a> ha editado un boom de <a href="<?php echo $act['boom_profile_url'] ?>"><?php echo $view->escape($act['boom_user']['name']) ?></a>:</p>
    <?php else: ?>
        <p class="info">Edit&eacute; un boom de <a href="<?php echo $act['boom_profile_url'] ?>"><?php echo $view->escape($act['boom_user']['name']) ?></a>:</p>
    <?php endif; ?>
    <p class="title">
        <a href="<?php echo $act['boom_url'] ?>"><?php echo $view->escape($act['boom_title']) ?></a>
    </p><date><?php echo $view->escape($act['boom_date']) ?></date>
</li>